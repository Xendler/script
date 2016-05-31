@extends('layout')

@section('content')
<div class="user-winner-block">

    <div class="title-block">
        <h2> <?php echo trans('top.title'); ?> </h2>
    </div>
 
<div id="minDepositMessage" class="msg-wrap">
            <div class="deposit-txt-info">
                 <?php echo trans('top.noadmingame'); ?>
            </div>

    <div class="user-winner-table">
        <table>
            <thead>
            <tr>
                <td> <?php echo trans('top.mesto'); ?> </td>
                <td class="winner-name-h"> <?php echo trans('top.profile'); ?> </td>
                <td class="participations-h"> <?php echo trans('top.uchastiy'); ?> </td>
                <td> <?php echo trans('top.pobed'); ?> </td>
                <td>Win rate</td>
                <td class="round-sum-h"> <?php echo trans('top.summabankov'); ?></td>
            </tr>
            </thead>
            <tbody>

            @foreach($users as $user)
            <tr>
                    <td class="winner-count">
                        <div class="count-block">{{ $place++ }}</div>
                    </td>

                    <td class="winner-name">
                        <div class="user-ava">
                            <img src="{{ $user->avatar }}">
                        </div>
                        <a href="/user/{{ $user->steamid64 }}"><span>{{ $user->username }}</span></a>
                    </td>

                    <td class="participations">{{ $user->games_played }}</td>
                    <td class="win-count">{{ $user->wins_count }}</td>
                    <td class="winrate">{{ $user->win_rate }}%</td>
                    <td class="round-sum">{{ round($user->top_value) }}</td>

           </tr>
           @endforeach
               </tbody>
              </table>
             </div>
            </div>
           </div>
         </main>
        </div>
    </div>
@endsection