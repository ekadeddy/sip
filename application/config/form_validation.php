<?php
$config = array(
		'ubah_password_rule' => array(
									array(
										'field' => 'password',
										'label' => 'Password',
										'rules' => 'trim|required|min_length[8]|regex_match[/[A-Z]|\s/]',
										'errors' => array(
											'required' => 'Password tidak boleh kosong!',
											'min_length' => 'Password Minimal 8 character!',
											'regex_match' => 'Kombinasi huruf besar dan huruf kecil!'

										),
									),
		)
);

