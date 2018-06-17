<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QA;
use App\Stemming;
use App\Dictionary;
use App\Recheck;
use DB;

class QAController extends Controller
{
    public function index()
    {
        $qa = QA::orderBy('created_at', 'DESC')->paginate(10);
        return view('qa.index', compact('qa'));
    }

    public function add()
    {
        return view('qa.add');
    }

    public function caseFloding($kalimat)
    {
        $getKalimat = explode(' ', $kalimat);
        $kalimat = '';
        for ($i=0; $i < count($getKalimat); $i++) {
            $filter = Floding($getKalimat[$i]);
            $kalimat .= $filter;
            $kalimat .= ' ';
        }

        $kalimatAsal = $this->Tokenizing(strtolower($kalimat));
        $stemKalimat = $this->stemKata($kalimatAsal);
        return $stemKalimat;
    }

    public function Tokenizing($kalimat)
    {
        $getKalimat = explode(' ', $kalimat);
        $kata = '';
        foreach ($getKalimat as $row) {
            if (!Filtering($row)) {
                $kata .= $row;
            }
            $kata .= ' ';
        }
        return $kata;
    }

    public function stemKata($kalimat)
    {
        $ex = explode(' ', $kalimat);
        $new_kalimat = '';
        foreach ($ex as $row) {
            $new_kalimat .= Del_Inflection_Suffixes($row);
            $new_kalimat .= ' ';
        }
        
        $der_kalimat = '';
        $ex_kalimat = explode(' ', $new_kalimat);
        foreach ($ex_kalimat as $row) {
            $der_kalimat .= Del_Derivation_Prefix($row);
            $der_kalimat .= ' ';
        }
        return $der_kalimat;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|string'
        ]);
        
        DB::beginTransaction();
        try {
            $qa = QA::firstOrCreate([
                'question' => $request->question,
                'answer_1' => $request->answer_1,
                'rate_1' => $request->rate_1,
                'answer_2' => $request->answer_2,
                'rate_2' => $request->rate_2,
                'answer_3' => $request->answer_3,
                'rate_3' => $request->rate_3,
                'answer_4' => $request->answer_4,
                'rate_4' => $request->rate_4,
                'answer_5' => $request->answer_5,
                'rate_5' => $request->rate_5
            ]);
            
            $st = Stemming::create([
                'kalimat' => $this->caseFloding($qa->question),
                'q_a_id' => $qa->id
            ]);

            $explodeWord = explode(' ', $st->kalimat);
            foreach ($explodeWord as $row) {
                if (!empty($row)) {
                    Dictionary::firstOrCreate([
                        'word' => trim($row)
                    ]);
                }
            }

            $this->reCheck($st);
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        DB::commit();
        return redirect(route('qa'));
    }

    public function delete($id)
    {
        $qa = QA::find($id);
        $qa->delete();
        return redirect(route('qa'));
    }

    public function getReCheck()
    {
        $stemming = Stemming::all();
        Recheck::truncate();
        $this->reCheck($stemming);
        return redirect()->back();
    }

    public function reCheck($stemming)
    {
        $dictionary = Dictionary::all()->pluck('id', 'word')->all();

        foreach ($stemming as $value) {
            $explodeStemming = explode(' ', $value->kalimat);

            foreach ($explodeStemming as $row) {
                if (array_key_exists(trim($row), $dictionary)) {
                    $check = Recheck::where('dictionary_id', $dictionary[$row])
                        ->where('stemming_id', $value->id);
                    if ($check->get()->count() > 0) {
                        $update = $check->first();
                        $update->update([
                            'total' => $update->total + 1
                        ]);
                    } else {
                        Recheck::create([
                            'dictionary_id' => $dictionary[$row],
                            'stemming_id' => $value->id,
                            'total' => 1
                        ]);
                    }
                }
            }
        }
    }

    public function details(Request $request)
    {
        $qa = QA::with('stemming')->findOrFail($request->id);
        $check = Recheck::with('dictionary')->where('stemming_id', $qa->stemming->id)->get();
        $data = [
            'qa' => $qa,
            'check' => $check
        ];
        return response()->json($data, 200);
    }
}
