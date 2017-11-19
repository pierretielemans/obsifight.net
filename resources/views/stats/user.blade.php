@extends('layouts.app')

@section('title', 'Eywek')

@section('content')
    <div class="ui container page-content">
        <h1 class="ui center aligned header">
            <img src="https://skins.obsifight.net/head/Eywek/64" class="ui rounded staff image" alt="Eywek">
            <div class="content">
                @if (isset($user->faction->name))
                    <a href="{{ url('/stats/faction/' . $user->faction->name) }}" class="ui blue image medium label">
                        {{ $user->faction->name }}
                        <div class="detail">{{ __('stats.faction.role.', $user->faction->role)  }}</div>
                    </a>
                @endif
                {{ $user->username }}
                <div class="sub header" style="margin-top:5px;"><i class="france flag"></i>
                    Inscrit {{ $user->register_date->diffForHumans() }}
                </div>
            </div>
        </h1>
        <div class="ui divider"></div>

        <div class="ui stackable grid" style="position:relative;">

            <div class="ui eight wide column">
                <h2 class="ui header">
                    Ses infos
                    <div class="sub header">Informations sur la saison en cours</div>
                </h2>
                <br>

                <div class="ui four small statistics">
                    <div class="statistic">
                        <div class="value">
                            {{ $user->online->total_time }}
                        </div>
                        <div class="label">
                            Heures de jeu
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ $user->stats->kills + $user->stats->deaths }}
                        </div>
                        <div class="label">
                            Combats
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ $user->stats->kills }}
                        </div>
                        <div class="label">
                            Tués
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ $user->stats->deaths }}
                        </div>
                        <div class="label">
                            Morts
                        </div>
                    </div>
                </div>
                <br>
                <div class="ui two small statistics">
                    <div class="statistic">
                        <div class="value">
                            {{ number_format($user->stats->blocks->placed, 0, ',', '.') }}
                        </div>
                        <div class="label">
                            Blocs posés
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ number_format($user->stats->blocks->broken, 0, ',', '.') }}
                        </div>
                        <div class="label">
                            Blocs cassés
                        </div>
                    </div>
                </div>

                <div class="ui divider"></div>

                @for($i = 1; $i <= 8; $i++)
                    <span class="ui {{ in_array($i, $user->versions) ? 'green' : 'red' }} label">
                        <i class="remove icon"></i>
                        Connecté pour la V{{ $i }}
                    </span>
                @endfor

                <div class="ui divider"></div>

                <span class="ui {{ $user->cape ? 'blue' : 'grey disabled' }} label">
                  <i class="remove icon"></i>
                  Possède une cape
                </span>
                <span class="ui {{ $user->skin ? 'blue' : 'grey disabled' }} label">
                  <i class="check icon"></i>
                  Possède un skin
                </span>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Dernière connexion {{ $user->online->last_connection->diffForHumans() }}</em>

            </div>
            <div class="ui vertical divider"></div>
            <div class="ui eight wide column">
                <h2 class="ui header">
                    Ses succès
                    <div class="sub header">Débloqués au cours de la saison {{ env('APP_VERSION_COUNT') }}</div>
                </h2>

                @foreach($faction->successList as $successList)
                    @foreach($successList as $successName => $successValue)
                        <span class="ui achievement {{ is_bool($successValue) ? ($successValue ? 'green' : 'red') : ($successValue == 100 ? 'green' : 'active p' . $successValue) }} label">
                            <i class="{{ $successValue == 100 || $successValue === true ? 'check' : ($successValue === false ? 'remove' : 'wait') }} icon"></i>
                            {{ $successName }}
                        </span>
                    @endforeach
                    @if (!$loop->last)
                        <div class="ui divider"></div>
                    @endif
                @endforeach

            </div>

        </div>
    </div>
@endsection
@section('style')
    <style media="screen">
        .ui.grid > .column + .divider, .ui.grid > .row > .column + .divider {
            left: 50%;
        }

        .ui.vertical.divider:after, .ui.vertical.divider:before {
            height: 100%;
        }

        .label {
            margin-top: 5px !important;
        }

        .achievement.active {
            color: #fff !important;
        }

        .achievement.active.label {
            position: relative;
            background: transparent !important;
        }

        .achievement.active.label:before {
            background: #767676;
            content: '';
            z-index: -2;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            border-radius: .28571429rem;
        }

        .achievement.active.label:after {
            background: #2185D0;
            content: '';
            z-index: -1;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: calc(100% - 80%);
            border-radius: .28571429rem;
        }
    </style>
@endsection
