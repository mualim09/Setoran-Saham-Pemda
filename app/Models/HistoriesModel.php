<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HistoriesModel extends Model
{
    use HasFactory;

    public static function calculateSetoran($tahun,$pemda_id){

        $result = DB::select('select totakhir.total_akhir, 
        totakhir.pemda_id ,totakhir.tahun , totgrow.total_grow from 
        t_saldo_akhir as totakhir 
        left join(select sum(nominal_setoran) as total_grow, 
        pemda_id from t_setoran where pemda_id='.$pemda_id.' and year(tanggal_setoran)='.$tahun.') as totgrow
        on totakhir.pemda_id= totgrow.pemda_id
        where totakhir.pemda_id= '.$pemda_id.'
        and totakhir.tahun = '.$tahun
        );

        return $result;
    }   


    public static function tambahSetoran($tahun,$tanggalSetoran, $nominalSetoran, $kodePemda, $triwulan){

        $check = DB::update("
        UPDATE t_saldo_akhir set 
            triwulan1 = 
                case 
                    when triwulan1 = 0 
                        then triwulan1 + 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 + ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 + 0
                                    else triwulan1 + ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan2 = 
                case 
                    when triwulan2 = 0 
                        then triwulan2 + 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 + ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 + 0	
                                    else triwulan2 + ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan3 = 
                case 
                    when triwulan3 = 0 
                        then triwulan3 + 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 + ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 + 0
                                    else triwulan3 + ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan4 = 
                case 
                    when triwulan4 = 0 
                        then triwulan4 + 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 + 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 + ".$nominalSetoran."
                                    else triwulan4 + ".$nominalSetoran."
                            END 
                        
                end	
            
            ,
            updated_at = now()
            ,
            total_akhir = total_akhir+ ".$nominalSetoran." where pemda_id= ".$kodePemda." and tahun between ".$tahun."  and ".date('Y')."

    "
    );   


        if($triwulan==1){
            DB::update('
            UPDATE t_saldo_akhir set  
            triwulan2 = 
            case	
                WHEN( triwulan2 <=0 ) THEN 0
                else triwulan2 + '.$nominalSetoran.'
            end, 
            triwulan3 = 
            case	
                WHEN( triwulan3 <=0 ) THEN 0
                else triwulan3 + '.$nominalSetoran.'
            end,
            triwulan4 = 
            case	
                WHEN( triwulan4 <=0 ) THEN 0
                else triwulan4 + '.$nominalSetoran.'
            end
            where pemda_id='.$kodePemda.' and tahun='.$tahun.'
            ');
        }else if($triwulan==2){
            DB::update('
            UPDATE t_saldo_akhir set    
            triwulan3 = 
            case	
                WHEN( triwulan3 <=0 ) THEN 0
                else triwulan3 + '.$nominalSetoran.'
            end,
            triwulan4 = 
            case	
                WHEN( triwulan4 <=0 ) THEN 0
                else triwulan4 + '.$nominalSetoran.'
            end
            where pemda_id='.$kodePemda.' and tahun='.$tahun.'
            ');
        }else if($triwulan==3){
            DB::update('
            UPDATE t_saldo_akhir set     
            triwulan4 = 
            case	
                WHEN( triwulan4 <=0 ) THEN 0
                else triwulan4 + '.$nominalSetoran.'
            end
            where pemda_id='.$kodePemda.' and tahun='.$tahun.'');
        }


        if($check){
            return true;
        }

        return false;
        
    }
    public static function kurangiSetoran($tahun,$tanggalSetoran, $nominalSetoran, $kodePemda,$triwulan){

       

        $check = DB::update("
        UPDATE t_saldo_akhir set 
            triwulan1 = 
                case 
                    when triwulan1 = 0 
                        then triwulan1 - 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 - ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan1 - 0
                                    else triwulan1 - ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan2 = 
                case 
                    when triwulan2 = 0 
                        then triwulan2 - 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 - ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan2 - 0	
                                    else triwulan2 - ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan3 = 
                case 
                    when triwulan3 = 0 
                        then triwulan3 - 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 - ".$nominalSetoran."
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan3 - 0
                                    else triwulan3 - ".$nominalSetoran."
                            END 
                        
                end	
            ,
            triwulan4 = 
                case 
                    when triwulan4 = 0 
                        then triwulan4 - 0
                            
                    else 
                    
                        
                            CASE 
                                    WHEN( (month('".$tanggalSetoran."')<=3) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=6) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=9) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 - 0
                                    WHEN( (month('".$tanggalSetoran."')<=12) AND (YEAR('".$tanggalSetoran."')=tahun) ) THEN triwulan4 - ".$nominalSetoran."
                                    else triwulan4 - ".$nominalSetoran."
                            END 
                        
                end	
            
            ,
            updated_at = now()
            ,
            total_akhir = total_akhir- ".$nominalSetoran." where pemda_id= ".$kodePemda." and tahun between ".$tahun."  and ".date('Y')."

    "
    );   

            if($triwulan==1){

                DB::update('
                UPDATE t_saldo_akhir set  

                
                triwulan2 = 
                case	
                    WHEN( triwulan2 <=0 ) THEN 0
                    else triwulan2 - '.$nominalSetoran.'
                end, 
                
                triwulan3 =  
                case	
                    WHEN( triwulan3 <=0 ) THEN 0
                    else triwulan3 - '.$nominalSetoran.'
                end,

                triwulan4 = 
                case	
                    WHEN( triwulan4 <=0 ) THEN 0
                    else triwulan4 - '.$nominalSetoran.'
                end

                where pemda_id='.$kodePemda.' and tahun='.$tahun.'
                ');
            }else if($triwulan==2){
                DB::update('
                UPDATE t_saldo_akhir set    
                triwulan3 =  
                case	
                    WHEN( triwulan3 <=0 ) THEN 0
                    else triwulan3 - '.$nominalSetoran.'
                end,

                triwulan4 = 
                case	
                    WHEN( triwulan4 <=0 ) THEN 0
                    else triwulan4 - '.$nominalSetoran.'
                end
                where pemda_id='.$kodePemda.' and tahun='.$tahun.'
                ');
            }else if($triwulan==3){
                DB::update('
                UPDATE t_saldo_akhir set     
                triwulan4 = 
                case	
                    WHEN( triwulan4 <=0 ) THEN 0
                    else triwulan4 - '.$nominalSetoran.'
                end
                where pemda_id='.$kodePemda.' and tahun='.$tahun);
            }
        
            


        if($check){
            return true;
        }

        return false;
        
    }


    
    
}
