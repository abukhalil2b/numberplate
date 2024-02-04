<?php

namespace App\Http\Helper;
use App\Models\Stock;

class Helperfunction {

    static public function randomPassword()
    {
        $smallLetters = 'a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z';
        $capitalLetters = 'A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z';
        $numbers = ',1,2,3,4,5,6,7,8,9,0';
        $specialChars = '!,@,#,$,%,&,*,(,)';

        $password = array(); //remember to declare $pass as an array

        $smallLettersArray =  explode(',', $smallLetters); //turn string into array
        $capitalLettersArray =  explode(',', $capitalLetters); //turn string into array
        $numbersArray =  explode(',', $numbers); //turn string into array
        $specialCharsArray =  explode(',', $specialChars); //turn string into array

        array_push($password, $smallLettersArray[rand(0, 25)]);
        array_push($password, $smallLettersArray[rand(0, 25)]);
        array_push($password, $capitalLettersArray[rand(0, 25)]);
        array_push($password, $capitalLettersArray[rand(0, 25)]);
        array_push($password, $numbersArray[rand(0, 9)]);
        array_push($password, $numbersArray[rand(0, 9)]);
        
        shuffle($password);
        return implode('', $password);
    }

    static public function plateCount($branchId,$size,$type){
        return Stock::selectRaw('SUM(`quantity`) as total')
            ->where([
                'cate' => 'plate',
                'branch_id' => $branchId,
                'type' => $type,
                'size' => $size,
            ])
            // ->groupby('size')
            ->first();
    }
}