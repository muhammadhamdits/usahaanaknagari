<?php

function formInputRow($label, $type, $name, $placeholder, $required, $old, $message){
    if($message){
        $error = 'is-invalid';
    }else{
        $error = '';
    }
    return "
    <div class='row justify-content-center'>
        <div class='col-8 form-group'>
            <label for='$name'>$label:</label>
            <input type='$type' name='$name' id='$name' class='form-control $error' value='$old' placeholder='Masukkan $placeholder ...' $required>
            <p class='text-danger text-sm'>$message</p>
        </div>
    </div>";
}

function formInputCol($label, $type, $name, $placeholder, $required, $old, $message, $label2, $type2, $name2, $placeholder2, $required2, $old2, $message2){
    if($message){
        $error = 'is-invalid';
    }else{
        $error = '';
    }
    if($message2){
        $error2 = 'is-invalid';
    }else{
        $error2 = '';
    }
    return "
    <div class='row justify-content-center'>
        <div class='col-4 form-group'>
            <label for='$name'>$label:</label>
            <input type='$type' name='$name' id='$name' class='form-control $error' value='$old' placeholder='Masukkan $placeholder ...' $required>
            <p class='text-danger text-sm'>$message</p>
        </div>
        <div class='col-4 form-group'>
            <label for='$name2'>$label2:</label>
            <input type='$type2' name='$name2' id='$name2' class='form-control $error2' value='$old2' placeholder='Masukkan $placeholder2 ...' $required2>
            <p class='text-danger text-sm'>$message2</p>
        </div>
    </div>";
}