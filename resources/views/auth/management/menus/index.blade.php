@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="row">
            <div class="col-7">
                <h3 id="residenttitle">Meal Menu</h3>
                <a href="{{ route('management.menus.add') }}" class="btn btn-primary btn-sm btn-outline-dark">Add New</a>
            </div>
        </div>

        <table class="table table table-striped table-bordered">
            <thead>
                <th>Date</th>
                <th class="text-center">View</th>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                    <tr class="{{ $menu->isCurrent() ? "table-success" : "" }}">
                        <td>
                            {{ $menu->period() }} {!! $menu->isCurrent() ? "<b>- Current Menu</b>" : ""  !!}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('management.menu.view', $menu) }}">
                                <i class="far fa-eye fa-lg view"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">There are no menus in the system</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $menus->links() }}
    </div>
@endsection