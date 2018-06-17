<?php
    function cekKamus($kata) {
        $kamus = \App\Kata_dasar::where('katadasar', $kata)->get();
        if ($kamus->count() > 0) {
            return true;
        }
        return false;
    }

    //fungsi untuk menghapus suffix seperti -ku, -mu, -kah, dsb
    function Del_Inflection_Suffixes($kata){ 
        $kataAsal = $kata;
        
        if(preg_match('/([km]u|nya|[kl]ah|pun)\z/i',$kata)){ // Cek Inflection Suffixes
            $__kata = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i','',$kata);

            return $__kata;
        }
        return $kataAsal;
    }

    // Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
    function Del_Derivation_Suffixes($kata){
        $kataAsal = $kata;
        if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
            $__kata = preg_replace('/(i|an)\z/i','',$kata);
            if(cekKamus($__kata)){ // Cek Kamus
                return $__kata;
            }else if(preg_match('/(kan)\z/i',$kata)){
                $__kata = preg_replace('/(kan)\z/i','',$kata);
                if(cekKamus($__kata)){
                    return $__kata;
                }
            }
    /*– Jika Tidak ditemukan di kamus –*/
        }
        return $kataAsal;
    }

    // Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
    function Del_Derivation_Prefix($kata){
        $kataAsal = $kata;

        /* —— Tentukan Tipe Awalan ————*/
        if(preg_match('/^(di|[ks]e)/',$kata)){ // Jika di-,ke-,se-
            $__kata = preg_replace('/^(di|[ks]e)/','',$kata);
            
            if(cekKamus($__kata)){
                return $__kata;
            }
            
            $__kata__ = Del_Derivation_Suffixes($__kata);
                
            if(cekKamus($__kata__)){
                return $__kata__;
            }
            
            if(preg_match('/^(diper)/',$kata)){ //diper-
                $__kata = preg_replace('/^(diper)/','',$kata);
                $__kata__ = Del_Derivation_Suffixes($__kata);
            
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
                
            }
            
            if(preg_match('/^(ke[bt]er)/',$kata)){  //keber- dan keter-
                $__kata = preg_replace('/^(ke[bt]er)/','',$kata);
                $__kata__ = Del_Derivation_Suffixes($__kata);
            
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
                
        }
        
        if(preg_match('/^([bt]e)/',$kata)){ //Jika awalannya adalah "te-","ter-", "be-","ber-"
            
            $__kata = preg_replace('/^([bt]e)/','',$kata);
            if(cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }
            
            $__kata = preg_replace('/^([bt]e[lr])/','',$kata);	
            if(cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }	
            
            $__kata__ = Del_Derivation_Suffixes($__kata);
            if(cekKamus($__kata__)){
                return $__kata__;
            }
        }
        
        if(preg_match('/^([mp]e)/',$kata)){
            $__kata = preg_replace('/^([mp]e)/','',$kata);
            if(cekKamus($__kata)){
                return $__kata; // Jika ada balik
            }
            $__kata__ = Del_Derivation_Suffixes($__kata);
            if(cekKamus($__kata__)){
                return $__kata__;
            }
            
            if(preg_match('/^(memper)/',$kata)){
                $__kata = preg_replace('/^(memper)/','',$kata);
                if(cekKamus($kata)){
                    return $__kata;
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]eng)/',$kata)){
                $__kata = preg_replace('/^([mp]eng)/','',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]eng)/','k',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]eny)/',$kata)){
                $__kata = preg_replace('/^([mp]eny)/','s',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]e[lr])/',$kata)){
                $__kata = preg_replace('/^([mp]e[lr])/','',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
            
            if(preg_match('/^([mp]en)/',$kata)){
                $__kata = preg_replace('/^([mp]en)/','t',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]en)/','',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }
                
            if(preg_match('/^([mp]em)/',$kata)){
                $__kata = preg_replace('/^([mp]em)/','',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
                
                $__kata = preg_replace('/^([mp]em)/','p',$kata);
                if(cekKamus($__kata)){
                    return $__kata; // Jika ada balik
                }
                
                $__kata__ = Del_Derivation_Suffixes($__kata);
                if(cekKamus($__kata__)){
                    return $__kata__;
                }
            }	
        }
        return $kataAsal;
    }