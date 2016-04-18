<?php

namespace Ainet\Controllers;

use Ainet\Models\User;

class UserController
{
    public function listUsers()
    {
        $users = User::all();
        $title = 'List users';

        // render_view('users.list', [
        //     'users' => $users,
        //     'title' => $title,
        // ]);
        render_view(
            'users.list',
            compact('users', 'title')
        );
    }

    public function addUser()
    {
        $title = 'Add user';
        $user = new User();
        $errors = [];
        if (empty($_POST)) {
            return render_view(
                'users.add',
                compact('title', 'user', 'errors')
            );
        }

        if (isset($_POST['cancel'])) {
            $this->redirectToHome();
        }

        $user = $this->createUserFromRequest();
        $errors = $this->validate($user);
        if (count($errors) > 0) {
            return render_view('users.add', compact('title', 'user', 'errors'));
        }
        User::add($user);
    }

    public function editUser()
    {
        $userId = input_value('user_id'); // Procura no POST
        if (is_null($userId) && isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];
        }
        if (is_null($userId)) {
            $this->redirectToHome();
        }

        $user = User::find($userId);
        if (is_null($user)) {
            $this->redirectToHome();
        }
        $title = 'Edit user';
        $errors = [];
        if (empty($_POST)) {
            return render_view('users.edit', compact('title', 'user', 'errors'));
        }

        if (isset($_POST['cancel'])) {
            $this->redirectToHome();
        }

        $this->updateUserFromRequest($user);
        $errors = $this->validateEditableFields($user);
        if (count($errors) > 0) {
            return render_view('users.edit', compact('title', 'user', 'errors'));
        }
        User::save($user);
    }

    public function deleteUser()
    {
        $userId = input_value('user_id');
        if (is_null($userId)) {
            $this->redirectToHome();
        }

        User::delete($userId);
        $this->redirectToHome();
    }

    private function validateEditableFields($user)
    {
        $errors = [];
        if (!trim($user->fullname)) {
            $errors['Fullname'] = 'Fullname is required.';
        } elseif (!preg_match('/^[a-zA-Z ]+$/', $user->fullname)) {
            $errors['Fullname'] = 'Fullname must only contain letters and spaces.';
        }
        if (!$user->email) {
            $errors['Email'] = 'Email is required.';
        } elseif (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
            $errors['Email'] = 'Invalid email address.';
        }
        if (is_null($user->type)) {
            $errors['UserType'] = 'User type is required.';
        } elseif ($user->type < 0 || $user->type > 2) {
            $errors['UserType'] = 'Type must be "administrator", "publisher" or "client".';
        }

        return $errors;
    }

    private function validate($user)
    {
        $errors = $this->validateEditableFields($user);

        if (!$user->password) {
            $errors['Password'] = 'Password is required.';
        } elseif (strlen($user->password) <= 8) {
            $errors['Password'] = 'Password must have at least 8 characters.';
        }

        if ($user->password && $user->password_confirmation != $user->password) {
            $errors['PasswordConfirmation'] = 'Password confirmation must be equal to password.';
        }

        return $errors;
    }

    private function updateUserFromRequest($user)
    {
        $user->fullname = input_value('fullname');
        $user->type = input_value('user_type');
        $user->email = input_value('email');
    }

    private function createUserFromRequest()
    {
        $user = new User();
        $user->fullname = input_value('fullname');
        $user->type = input_value('user_type');
        $user->email = input_value('email');
        $user->password = input_value('password');
        $user->password_confirmation = input_value('password_confirmation');

        return $user;
    }

    private function redirectToHome()
    {
        header('Location: users.php');
        exit(0);
    }
}
