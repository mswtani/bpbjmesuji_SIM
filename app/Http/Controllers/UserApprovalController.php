<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserApprovalController extends Controller
{
    /**
     * Menampilkan daftar user ASN yang menunggu persetujuan.
     */
    public function index()
    {
        $users = User::query()
            ->with([
                'position',
                'role',
            ])
            ->where('user_type', 'asn')
            ->where('approval_status', 'pending')
            ->latest()
            ->paginate(15);

        return view(
            'users.approvals.index',
            compact('users')
        );
    }

    /**
     * Menyetujui akun ASN.
     */
    public function approve(
        Request $request,
        User $user
    ) {
        if (! $user->isAsn()) {
            abort(404);
        }

        if (! $user->isPendingApproval()) {
            return back()->with(
                'error',
                'Akun ini tidak sedang menunggu persetujuan.'
            );
        }

        if ($user->is($request->user())) {
            return back()->with(
                'error',
                'Anda tidak dapat menyetujui akun Anda sendiri.'
            );
        }

        $user->update([
            'approval_status' => 'approved',
            'approved_by' => $request->user()->id,
            'approved_at' => now(),
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);

        return back()->with(
            'success',
            'Akun ASN berhasil disetujui.'
        );
    }

    /**
     * Menolak akun ASN.
     */
    public function reject(
        Request $request,
        User $user
    ) {
        if (! $user->isAsn()) {
            abort(404);
        }

        if (! $user->isPendingApproval()) {
            return back()->with(
                'error',
                'Akun ini tidak sedang menunggu persetujuan.'
            );
        }

        if ($user->is($request->user())) {
            return back()->with(
                'error',
                'Anda tidak dapat menolak akun Anda sendiri.'
            );
        }

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        $user->update([
            'approval_status' => 'rejected',
            'approved_by' => null,
            'approved_at' => null,
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with(
            'success',
            'Akun ASN berhasil ditolak.'
        );
    }
}