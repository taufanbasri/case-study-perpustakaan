<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailRegisteredVerification;
use App\Http\Requests\StoreMemberRequest;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $builder)
    {
        if ($request->ajax()) {
            $members = Role::where('name', 'member')->first()->users;

            return DataTables::of($members)
                    ->addColumn('action', function ($member) {
                        return view('datatable._action', [
                            'member' => $member,
                            'show_url' => route('members.show', $member->id),
                            'edit_url' => route('members.edit', $member->id),
                            'delete_url' => route('members.destroy', $member->id),
                            'confirm_message' => 'Yakin akan menghapus ' . $member->name
                        ]);
                    })->toJson();
        }

        $html = $builder->columns([
            ['data' => 'name', 'name' => 'name', 'title' => 'Nama'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false],
        ]);

        return view('members.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMemberRequest $request)
    {
        $password = str_random(6);

        $data = $request->all();
        $data['password'] = bcrypt($password);

        // bypass verifikasi
        $data['is_verified'] = 1;

        $member = User::create($data);

        $memberRole = Role::where('name', 'member')->first();

        $member->attachRole($memberRole);

        Mail::to($member)->send(new EmailRegisteredVerification($member, $password));

        return redirect()->route('members.index')->with('flash_notification', [
            'level' => 'success',
            'message' => "Berhasil menyimpan member dengan email $member->email dan password <strong>$password</strong>"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $member)
    {
        return view('members.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $member)
    {
        return view('members.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMemberRequest $request, User $member)
    {
        $member->update($request->only('name', 'email'));

        return redirect()->route('members.index')->with('flash_notification', [
            'level' => 'success',
            'message' => 'Berhasil memperbarui member ' .$member->name
        ]);
    }

    // tugas
    // jika member sudah pernah meminjam buku, tidak boleh dihapus
    // jika member sedang meminjam buku, tidak boleh dihapus
    public function destroy(User $member)
    {
        if ($member->hasRole('member')) {
            $member->delete();

            return redirect()->route('members.index')->with('flash_notification', [
                'level' => 'danger',
                'message' => "Berhasil menghapus member $member->name"
            ]);
        }

        return redirect()->route('members.index')->with('flash_notification', [
            'level' => 'danger',
            'message' => "Gagal menghapus admin $member->name"
        ]);
    }
}
