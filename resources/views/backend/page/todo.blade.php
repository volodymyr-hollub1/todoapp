@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class=" row ml-4 justify-content-start" >
        <div class="p-2  col-lg-8">
            <div class="card   shadow-lg">
                <div class="card-body">
                    <table class="table borderless">
                        <tbody class="table-body">

                        @if(!$todo->isEmpty())
                            @foreach ($todo as $t)
                                <tr data-q="{{ $t->id }}">
                                    <th scope="row">{{ $t->id }}</th>
                                    <td style="word-wrap: break-word, min-width:2rem; max-width:30rem;" @if($t->status == 'done')class="done"@endif>{{ $t->text }}</td>
                                    <td class="text-right">
                                        @if($t->status == 'new')
                                        <button onclick="done({{ $t->id }})" class="btn btn-success mr-4">done</button>
                                        @endif
                                        <button onclick="remove({{ $t->id }})" class="btn btn-danger @if($t->status == 'new') remove-btn-hide @endif">remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        {{-- <tr data-q="1">
                            <th scope="row">1</th>
                            <td style="word-wrap: break-word, min-width:2rem; max-width:30rem;">Mark</td>
                            <td class="text-right">
                                <button onclick="done(1)" class="btn btn-success mr-4">done</button>
                                <button onclick="remove(1)" class="btn btn-danger">remove</button>
                            </td>
                        </tr> --}}


                        <h4 id="empty" class="text-primary" @if(!$todo->isEmpty())style="display:none;"@endif>all done</h4>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="p2 col-lg-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <div class="form-group">
                        <textarea type="text" id="add-text" class="form-control" rows="3" style="resize:none;"></textarea>
                    </div>
                    <div class="form-group">
                        <button onclick="add()" class="btn btn-primary add-btn"><span class="btn-text">Add</span><span class="loader">@include('layouts.loader')</span></button>
                    </div>
                    <div class="form-group">
                        <p class="text-danger error">Input is empty! Enter the text</p>
                    </div>
                </div>
            </div>
            <div class="card shadow-lg mt-4">
                <div class="card-body">
                    <div class="form-group">
                        <span class="text-primary">@include('layouts.profile_icon') {{ auth()->user()->username }}</span>
                    </div>
                    <div class="form-group">
                        <a class="btn btn-primary" href="{{ route('logout') }}">Log out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('myjs', 'todoapp')
@section('script')
window.Laravel = {'csrfToken': '{{csrf_token()}}'}
@endsection

