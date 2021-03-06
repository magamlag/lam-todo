<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Project;
use Redirect, Input;

/**
 * Class ProjectsController
 *
 * CRUD class for Projects
 * @package App\Http\Controllers
 */
class ProjectsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$projects = Project::all();
		return view( 'projects.index', compact( 'projects' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('projects.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store( Request $request ) {

		$v = \Validator::make( $request->all(), Project::$rules );

		if ( $v->fails() )
			return redirect()->back()->withErrors($v->errors());

		Project::create( $request->all() );

		return Redirect::route( 'projects.index' )->with( 'message', 'Project created' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function show( Project $project ) {
		return view( 'projects.show', compact( 'project' ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  Project $project
	 * @return Response
	 */
	public function edit( Project $project )
	{
		//
		return view('projects.edit', compact('project'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Project $project
	 * @param  Request $request
	 * @return Redirect
	 */
	public function update( Project $project, Request $request )
	{
		$v = \Validator::make( $request->all(), Project::$rules );

		if ( $v->fails() )
			return redirect()->back()->withErrors( $v->errors());

		$input = array_except( $request->all(), '_method' );

		$project->update( $input );

		return Redirect::route('projects.show', $project->slug)->with('message', 'Project updated.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  Project $project
	 * @return Redirect
	 */
	public function destroy(Project $project) {
		$project->delete();
		return Redirect::route( 'projects.index' )->with( 'message', 'Project deleted.' );
	}
}
