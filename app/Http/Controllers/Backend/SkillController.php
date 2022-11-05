<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{

    /**
     * Show the skills page.
     *
     * @return \Illuminate\View\View
     */
    public function index() 
    {
        $skills = Skill::all();
        return view('skills.index', compact('skills'));
    }


    /**
     * Create skill and view create page.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('skills.create');
    }


    /**
     * Store a new skill image.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkillRequest $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('skills');

            Skill::create([
                'name' => $request->name,
                'image'=> $image
            ]);

            return redirect('/skills')->with('status', 'Skill saved successfully!');;
        }
        return back();
    }


    /**
     * Edit skill.
     *
     * @return \Illuminate\View\View
     */
    public function edit(Skill $skill)
    {
        return view('skills.edit', compact('skill'));
    }


   /**
     * Update the skill name.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'image'=> ['nullable', 'image']
        ]);

        $image = $skill->image;
        if ($request->hasFile('image')) {
            Storage::delete($skill->image);
            $image = $request->file('image')->store('skills');
        }

        $skill->update([
            'name' =>$request->name,
            'image'=>$image
        ]);

        return redirect('/skills')->with('status', 'Skill updated successfully!');
    }


    public function destroy(Skill $skill)
    {
        Storage::delete($skill->image);
        $skill->delete();

        return back()->with('status', 'Skill deleted successfully!');
    }
}
