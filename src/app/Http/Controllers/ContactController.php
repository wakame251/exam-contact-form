<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        if ($request->has('back')) {
            $data = $request->all();

            // tel が文字列なら配列に戻す
            if (isset($data['tel']) && is_string($data['tel'])) {
                $data['tel'] = [
                    substr($data['tel'], 0, 3),
                    substr($data['tel'], 3, 4),
                    substr($data['tel'], 7),
                ];
            }

            return redirect('/')->withInput($data);
        }

        $contact = $request->all();

        // tel 配列 → 文字列（表示用）
        if (is_array($contact['tel'])) {
            $contact['tel'] = implode('', $contact['tel']);
        }

        $category = Category::find($contact['category_id']);

        return view('confirm', compact('contact', 'category'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        // tel が配列なら文字列に変換
        if (is_array($data['tel'])) {
            $data['tel'] = implode('', $data['tel']);
        }

        Contact::create($data);

        return view('thanks');
    }
}
