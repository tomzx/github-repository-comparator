<?php namespace App\Http\Controllers;

use GRC\Repository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index(Repository $repository)
	{
		$repositories = $repository->get(array_keys(Session::get('repositories', [])));

		$this->updateSessionRepositories($repositories);

		return view('welcome', [
			'repositories' => $repositories,
		]);
	}

	protected function updateSessionRepositories(array $repositories)
	{
		$sessionRepositories = array_keys(Session::get('repositories', []));
		$sessionRepositories = array_filter($sessionRepositories, function ($repository) use ($repositories) {
			return array_key_exists($repository, $repositories);
		});
		$sessionRepositories = array_fill_keys($sessionRepositories, 1);
		Session::set('repositories', $sessionRepositories);
	}

	public function add(Repository $repository)
	{
		$repositories = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', Input::get('repositories'))));

		$validRepositories = [];
		$errors = [];
		foreach ($repositories as $repo) {
			if ( ! $repository->isValidRepository($repo) || $repository->getOne($repo) === null) {
				$errors[] = $repo;
			} else {
				$validRepositories[] = $repo;
			}
		}

		$sessionRepositories = Session::get('repositories');
		$repositories = array_combine($validRepositories, array_fill(0, count($validRepositories), 1));
		$sessionRepositories = array_merge($sessionRepositories, $repositories);
		Session::put('repositories', $sessionRepositories);

		if (!empty($validRepositories) && empty($errors)) {
			return redirect('/')->with('notice_success', 'Repositories added!');
		} else if ( ! empty($errors)) {
			return redirect('/')->with('notice_error', 'Some repositories are invalid: <br/>'.implode('<br/>', $errors));
		} else {
			return redirect('/');
		}
	}

	public function remove(Repository $repository, $repo)
	{
		$repositoryValue = $repo;

		if ( ! $repository->isValidRepository($repositoryValue)) {
			return redirect('/')->with('notice_error', 'Invalid repository');
		}

		$repositories = Session::get('repositories');
		unset($repositories[$repositoryValue]);
		Session::put('repositories', $repositories);

		return redirect('/')->with('notice_success', 'Repository removed!');
	}
}
