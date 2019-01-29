@extends('layout.master')
@section('content')
    <div class="main">
        @include('layout.messages')
        @if (is_null($menu))
            <h5 class="text-center">There is currently no menu set for this week. Check back soon</h5>
        @else
            <div class="table-responsive">
                <h3 id="residenttitle">Meal Menu</h3>
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
                                <p class="mealdescription">
                                    @if(! is_null($menuDay->lunch))
                                        {!! nl2br(e($menuDay->lunch)) !!}
                                    @else
                                       --
                                    @endif
                                </p>
                            </td>
                            <td>
                                <p><strong>Dinner:</strong></p>
                                <p class="mealdescription">
                                    @if(! is_null($menuDay->dinner))
                                        {!! nl2br(e($menuDay->dinner)) !!}
                                    @else
                                        --
                                    @endif
                                </p>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection