import auth from "../middleware/auth";
import guest from "../middleware/guest";
import Home from '../pages/Home';
import Login from '../pages/auth/Login';
import Register from '../pages/auth/Register';
import AdminUsersIndex from '../pages/admin/AdminUsersIndex';
import UsersIndex from '../pages/users/UsersIndex';
import UsersShow from '../pages/users/UsersShow';
import Route from 'vue-routisan';

// define view resolver
// Route.setViewResolver((c) => require('./views/' + c));

/*
 * Guest Routes
 */
Route.group({ beforeEnter: guest }, () => {
    Route.view('/login', Login).name('login');
    Route.view('/register', Register).name('register');
    // Route.view('/forgot', 'Forgot');
    // Route.view('reset', 'Reset');
});

/*
 * Auth Routes
 */
Route.group({ beforeEnter: auth}, () => {
    Route.view('/', Home).name('home');

    Route.view('users', UsersIndex).name('users.index');
    Route.view('users/:id', UsersShow).name('users.show');

    /*
     * Admin Routes
     */
    Route.view('admin/users', AdminUsersIndex).name('admin.users.index');
});

export default Route.all();