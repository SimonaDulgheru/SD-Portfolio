<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index() 
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
    }
}
