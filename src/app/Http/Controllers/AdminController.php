<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = $this->buildSearchQuery($request);

        $contacts = $query->paginate(7)->withQueryString();

        return view('admin', compact('contacts', 'categories'));
    }

    public function export(Request $request): StreamedResponse
    {
        $query = $this->buildSearchQuery($request);

        $contacts = $query->get();

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($contacts) {
            $out = fopen('php://output', 'w');

            // Excel文字化け対策（UTF-8 BOM）
            fwrite($out, "\xEF\xBB\xBF");

            fputcsv($out, [
                'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容', '作成日'
            ]);

            foreach ($contacts as $c) {
                $gender = $c->gender == 1 ? '男性' : ($c->gender == 2 ? '女性' : 'その他');

                fputcsv($out, [
                    trim($c->last_name . ' ' . $c->first_name),
                    $gender,
                    $c->email,
                    $c->tel,
                    $c->address,
                    $c->building,
                    optional($c->category)->content,
                    $c->detail,
                    optional($c->created_at)->format('Y-m-d'),
                ]);
            }

            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.index')
            ->with('message', '削除しました');
    }

    private function buildSearchQuery(Request $request)
    {
        $query = Contact::with('category')->orderByDesc('id');

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $keywordNoSpace = preg_replace('/\s+/u', '', $keyword);

            $query->where(function ($q) use ($keyword, $keywordNoSpace) {
                $q->where('last_name', 'like', "%{$keyword}%")
                  ->orWhere('first_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$keywordNoSpace}%"])
                  ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$keyword}%"]);
            });
        }

        if ($request->filled('gender')) {
            $query->where('gender', $request->input('gender'));
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        return $query;
    }
}
