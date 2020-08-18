<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userinfo extends Model
{
    const CREATED_AT = 'CreatedDate';
    const UPDATED_AT = 'ModifiedDate';
    
    protected $table='userinfo';
    
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name', 'email', 'phone', 'city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    
    public static function validationRules($rulesArray = []) {
        $alphachracters = '/^[A-z a-z.]+$/';
        $numbersOnly = '/^[0-9]+$/';
        return array_merge(
        [
            'name' => ['required','regex:'.$alphachracters],
            'email' => ['required','email'],
            'phone' => ['required','digits:10','regex:'.$numbersOnly],                                                    
            'city' => ['required','regex:'.$alphachracters]          
        ], 
        $rulesArray);
    }
    
    public static function validationRulesMessages($rulesMessageArray = []) {
        return array_merge(
        [
            'name.required' => 'Please enter name',
            'name.regex' => 'Please enter name in characters only',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',            
            'phone.required' => 'Please enter phone',
            'phone.digits' => 'Please enter phone in 10 digits',
            'phone.regex' => 'Please enter phone in numbers only',
            'city.required' => 'Please enter city',
            'city.regex' => 'Please enter city in characters only',
        ], 
        $rulesMessageArray);
    }
    
    
}
