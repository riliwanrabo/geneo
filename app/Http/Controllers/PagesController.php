<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.home');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function store(ContactFormRequest $request)
    {
        // save form
        $data = collect($request->all())->toJson();
        ['email' => $email] = $request->all();
        if ($store = cache()->put($email . '-contact', $data)) {
            if ($request->has('file')) {
                $file = $request->get('file');
                $newFile = explode('-', $file);
                Storage::move($file, 'uploads/' . $newFile[1]);
            }
            return redirect('/contact')->with('success', 'Your message has been received.');
        }

        return redirect('/contact')->withInput()->with('error', 'Something went wrong, Your message was not received.');
    }

    public function uploadFile(Request $request)
    {
        $validator = Validator::make($request->only('file'), [
            'file' => ['sometimes', 'file', 'mimes:pdf,csv,xlsx,xls']
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'upload-' . time() . '.' . $file->getClientOriginalExtension();
            return $file->storePubliclyAs('tmp/uploads', $filename);
        }
    }
}
