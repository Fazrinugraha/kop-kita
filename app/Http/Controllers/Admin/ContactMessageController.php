<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->paginate(10); // Ubah dari all() ke paginate()
        return view('pages.admin.contact-messages.index', compact('messages'));
    }

    public function show(Contact $contact)
    {
        return view('pages.admin.contact-messages.show', compact('contact'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('pages.admin.contact-messages.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}
