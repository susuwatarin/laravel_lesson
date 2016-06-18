<?php
/*
Helper関数：助けになる、その動作専用の関数
*/

// Delete_form（記事削除）関数
function delete_form($urlParams, $label = 'Delete')
{
    $form = Form::open(['method' => 'DELETE', 'url' => $urlParams]);
    $form .= Form::submit($label, ['class' => 'btn btn-danger']);
    $form .= Form::close();
 
    return $form;
}
