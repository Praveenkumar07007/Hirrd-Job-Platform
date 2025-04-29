<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $jwelery = [
            ['id' => 1, 'name' => 'Gold necklace', 'price' => 15000],
            ['id' => 2, 'name' => 'diamond ring', 'price' => 25000],
            ['id' => 3, 'name' => 'Silver Earring', 'price' => 3000],
            ['id' => 4, 'name' => 'Bracelet', 'price' =>8000],
            ['id' => 5, 'name' => 'Ruby Pendant','price' => 12000]
        ];

        return view('jwelery.index', compact('jwelery'));
    }

    public function show($id)
    {
        $jweleryDetails = [
            1 => ['id' => 1, 'name' => 'Gold necklace', 'price' => 15000,'Description' =>'gold plated bracelet with intrincate patterns'],
            2 => ['id' => 2, 'name' => 'diamond ring', 'price' => 25000,'Description' =>'gold plated bracelet with intrincate patterns'],
            3 => ['id' => 3, 'name' => 'Silver Earring', 'price' => 3000,'Description' =>'gold plated bracelet with intrincate patterns'],
            4 => ['id' => 4, 'name' => 'Bracelet', 'price' => 8000,'Description' =>'gold plated bracelet with intrincate patterns'],
            5 => ['id' => 5, 'name' => 'Ruby Pendant', 'price' => 12000,'Description' =>'gold plated bracelet with intrincate patterns'],
        ];

        if (!isset($jweleryDetails[$id])) {
            abort(404, "Jwelery  not found");
        }

        return view('jwelery.show', ['jwelery' => $jweleryDetails[$id]]);
    }
}
