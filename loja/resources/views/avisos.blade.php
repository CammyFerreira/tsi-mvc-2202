<!-- Usa o HTML/CSS/JS do layout/padrão.blade.php -->
@extends('layouts.padrao')

<!-- Define o título da página/view -->
@section('title', 'Quadro de Avisos')

<!-- Usa o sidebar do layout padrão -->
@section('sidebar')
    @parent
    <br>---------Barra Superior Específica----------
@endsection

<!-- Para inserir o conteúdo no layout padrão-->
@section('content')

    <h1>Quadro de Avisos</h1>
    <br>
    <br>

    <!-- Looping para vetor do blade -->
    @foreach($avisos as $aviso)

    <!-- If no blade -->
        @if(($aviso['exibir']))
            {{$aviso['data']}}: {{$aviso['aviso']}}
            <br>
        @endif

    @endforeach

    <?php
        foreach($avisos as $aviso){

            if($aviso['exibir']){
                echo "{$aviso['data']}: {$aviso['aviso']} <br>";
            }else{
                echo "Não há avisos <br>";
            }
        }

    ?>

@endsection
