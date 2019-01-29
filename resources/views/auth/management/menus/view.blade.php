@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        <div class="table-responsive">
            <h3 id="residenttitle">Meal Menu - {{ $menu->period() }}</h3>
            <div class="clearfix"></div>
            <div class="mb-2">
                <a href="{{ route('management.menu.delete', $menu) }}" class="edit">
                    <i class="far fa-trash-alt"></i>
                    Delete
                </a>
            </div>
            <table class="table table-bordered menutable">
                <tbody>
                    @foreach($menu->days as $menuDay)
                        <tr>
                            <th class="menuday" colspan="2">
                                {{ $menuDay->date->format('l') }} ({{ $menuDay->date->format('dS M') }})
                            </th>
                        </tr>
                        <tr>
                            <td class="menu">
                                <p><strong>Lunch:</strong></p>
                                <p class="mealdescription"></p>
                                <p>
                                    @if(! is_null($menuDay->lunch))
                                        {!! nl2br(e($menuDay->lunch)) !!} (<a class="edit" href="{{ route('management.menu.edit-day', [$menu, $menuDay]) }}">Edit</a>)
                                    @else
                                        <a class="edit" href="{{ route('management.menu.edit-day', [$menu, $menuDay]) }}">
                                            Set
                                        </a>
                                    @endif
                                </p>
                            </td>
                            <td>
                                <p><strong>Dinner:</strong></p>
                                <p class="mealdescription"></p>
                                <p>
                                    @if(! is_null($menuDay->dinner))
                                        {!! nl2br(e($menuDay->dinner)) !!} (<a class="edit" href="{{ route('management.menu.edit-day', [$menu, $menuDay]) }}">Edit</a>)
                                    @else
                                        <a class="edit" href="{{ route('management.menu.edit-day', [$menu, $menuDay]) }}">
                                            Set
                                        </a>
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection