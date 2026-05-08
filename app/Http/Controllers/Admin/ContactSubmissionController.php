<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactSubmission::latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by name, email, or service
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('service', 'like', "%{$search}%");
            });
        }

        $submissions = $query->paginate(20)->withQueryString();

        $counts = [
            'all'         => ContactSubmission::count(),
            'new'         => ContactSubmission::where('status', 'new')->count(),
            'in_progress' => ContactSubmission::where('status', 'in_progress')->count(),
            'resolved'    => ContactSubmission::where('status', 'resolved')->count(),
        ];

        return view('admin.contacts.index', compact('submissions', 'counts'));
    }

    public function show(ContactSubmission $contact)
    {
        // Mark as read jika masih baru
        if ($contact->status === 'new') {
            $contact->update([
                'status'  => 'in_progress',
                'read_at' => now(),
            ]);
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function updateStatus(Request $request, ContactSubmission $contact)
    {
        $request->validate([
            'status' => 'required|in:new,in_progress,resolved',
        ]);

        $contact->update(['status' => $request->status]);

        return back()->with('success', 'Status pesan berhasil diperbarui.');
    }

    public function destroy(ContactSubmission $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contacts.index')
                         ->with('success', 'Pesan berhasil dihapus.');
    }
}