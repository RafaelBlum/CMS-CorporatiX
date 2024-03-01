<?php

use App\Post;
use App\User;
use App\Like;
use App\Questionaire;
use App\Survey;
use App\Categoria;
use App\Comment;
use App\Config;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Support\Facades\DB;
use Filament\Contracts\Plugin;
use Filament\FilamentManager;

if(!function_exists('aniversariantes_mes')){
    function aniversariantes_mes(){
        $users = User::whereMonth('nascimento', '=', Carbon::now('m'))->get();
        return $users;
    }
}

if(!function_exists('configura')){
    function configura(){
        $teste = Config::where('id', '=', 1)->get();
        return $teste->logo;
    }
}

if(!function_exists('agora')){
    function agora(){
        return date('d/m/y H:i:s');
    }
}

if(!function_exists('total_posts')){
    function total_posts(){
        $posts = Post::all();

        return $posts->count();
    }
}

if(!function_exists('invalid_posts')){
    function invalid_posts(){
        $dataHoje = Carbon::now();
        $postsInvalids = Post::where('validate_at', '<', $dataHoje->toDateString())
            ->get();

        return $postsInvalids->count();
    }
}

if(!function_exists('user_on')){
    function user_on(){
        $users = User::all();
        $total = 0;
        foreach($users as $user){
            if(Cache::has('is_online' . $user->id)){
                $total++;
            }
        }
        return $total;
    }
}

if(!function_exists('user_all')){
    function user_all(){
        $users = User::all();
        return $users->count();
    }
}

if(!function_exists('user_inativos')){
    function user_inativos(){
        $users = User::where('status', '!=', 'ativo')->get();
        return $users->count();
    }
}

if(!function_exists('user_ativos')){
    function user_ativos(){
        $user_admin = User::where('status', '=', 'ativo')->get();
        return $user_admin->count();
    }
}

if(!function_exists('user_admin')){
    function user_admin(){
        $users = User::where('status', '=', 'ativo')
            ->where('role_id', '=', 1)
            ->get();
        return $users->count();
    }
}

if(!function_exists('user_user')){
    function user_user(){
        $users = User::where('status', '=', 'ativo')
            ->where('role_id', '=', 2)
            ->get();
        return $users->count();
    }
}

if(!function_exists('likes_post')){
    function likes_post($data){

        $sql = "SELECT COUNT(l.like) AS likes FROM likes l WHERE l.post_id = ". $data . " AND l.like = 1";
        $likes = DB::select($sql);

        $curtidas = [];
        foreach($likes as $array){
            array_push( $curtidas, $array->likes );
        }
        return array_sum($curtidas);
    }
}

if(!function_exists('deslikes_post')){
    function deslikes_post($data){

        $sql = "SELECT COUNT(l.like) AS likes FROM likes l WHERE l.post_id = ". $data . " AND l.like = 0";
        $deslikes = DB::select($sql);

        $curtidas = [];
        foreach($deslikes as $array){
            array_push( $curtidas, $array->likes );
        }
        return array_sum($curtidas);
    }
}

if(!function_exists('likes')){
    function likes(){
        $likes = Like::all();

        $tot_likes = 0;
        foreach($likes as $like){
            if($like->like == 1){
                $tot_likes++;
            }
        }

        return $tot_likes;
    }
}

if(!function_exists('deslikes')){
    function deslikes(){
        $deslikes = Like::all();

        $tot_deslikes = 0;
        foreach($deslikes as $like){
            if($like->like == 0){
                $tot_deslikes++;
            }
        }

        return $tot_deslikes;
    }
}

if(!function_exists('totalLikes')){
    function totalLikes(){
        $tot_likes = Like::all();

        $tot = 0;
        foreach($tot_likes as $like){
         $tot++;
        }

        return $tot;
    }
}

if(!function_exists('views')){
    function views(){
        $posts = Post::all();

        $tot_views = 0;
        foreach($posts as $cont){
            $tot_views = $tot_views + $cont->view;
        }

        return $tot_views;
    }
}

if(!function_exists('comentarios')){
    function comentarios(){
        $comments = Comment::all();

        return $comments->count();
    }
}

if(!function_exists('categorias')){
    function categorias(){
        $categorias = Categoria::all();

        return $categorias->count();
    }
}

if(!function_exists('calc_idade')){
    function calc_idade($data){

        if($data == null){
            $data = now();
        }
        $idade = explode('-', $data);
        $idade2 = explode('-', now());
        $teste = $idade2[0]-$idade[0];

        if($idade[1] <= $idade2[1]){
            //10 - 9
            if($idade[2] <= $idade2[2]){
                return $teste;
            }else{
                $teste--;
            }
        }else{
            $teste--;
        }

        return $teste;
    }
}

if(!function_exists('solicitacoes')){
    function solicitacoes(){
        $users = User::where('status', '=', 'inativo')->get();
        return $users->count();
    }
}

if(!function_exists('respond_survey')){
    function respond_survey($data){

        $pesquisa = Survey::where('questionaire_id', $data)->get();

        $filtro = $pesquisa->whereIn('email', Auth::user()->email);

        //USU�RIO J� RESPONDEU
        if($filtro->count() == 0){
            return true;
        }

        return false;
    }
}

if(!function_exists('survey_names')){
    function survey_names($data){

        $pesquisa = Survey::where('questionaire_id', $data)->get();

        return $pesquisa;
    }
}

if(!function_exists('tot_questio_finalizados')){
    function tot_questio_finalizados(){
        $questionarios = Questionaire::where('status', '=', 'Finalizado')->get();
        $total = 0;
        foreach($questionarios as $quest){
          $total = $quest->respondidas + $total;
        }
        return $total;
    }
}

if(!function_exists('tot_questions_aberto')){
    function tot_questions_aberto(){
        $questionarios = Questionaire::where('status', '=', 'Aberto')->get();

        return $questionarios->count();
    }
}

if(!function_exists('tot_questions_views')){
    function tot_questions_views(){
        $questionarios = Questionaire::where('status', '=', 'Finalizado')->get();
        $total = 0;
        foreach($questionarios as $quest){
            $total = $quest->view + $total;
        }
        return $total;
    }
}

if(!function_exists('total_survey')){
    function total_survey(){
        $quests = Questionaire::all();
        return $quests->count();
    }
}

if(!function_exists('total_finalizados')){
    function total_finalizados(){
        $questionarios = Questionaire::where('status', '=', 'Finalizado')->get();

        return $questionarios->count();
    }
}
