<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\Users\ListUsers;

/**
 * Users Api
 *
 * @Resource("Users", uri="/users")
 */
class UserController extends ApiController
{
    /**
     * @var \App\Services\Users\ListUsers
     */
    protected $listUsers;

    /**
     * @param \App\Services\Users\ListUsers $listUsers
     * @return void
     */
    public function __construct(ListUsers $listUsers)
    {
        $this->listUsers = $listUsers;
    }

    /**
     * List users
     *
     * @Get("/")
     * @Versions({"v1"})
     * @Parameters({
     *      @Parameter("page", description="Current page.", default=1),
     *      @Parameter("limit", description="Users per page.", default=50)
     * })
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $users = $this->listUsers->dispatch($request->all());

        return $this->response->paginator($users, new UserTransformer);
    }

    /**
     * Create user
     *
     * Registra um novo usuario com `e-mail`, `username` e `password`.
     *
     * @Post("/")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({username": "foo", "email": "foo@billovos.com.br", "password": "bar"}),
     *      @Response(201, body={"id": 10, "username": "foo", "email": "foo@billovos.com.br"}),
     *      @Response(422, body={"error": {"username": {"Username is already taken."}}})
     *      @Response(422, body={"error": {"email": {"E-mail is already taken."}}})
     * })
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed
     */
    public function create(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make($inputs, [
            'username' => 'required|max:255',
            'email'    => 'required|max:255',
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create new user.', $validator->errors());
        }

        try {
            $user = $this->dispacth(new CreateUser($inputs));
        } catch (Execption $error) {
            return $this->response->errorInternal($error->getMessage());
        }

        return $this->response->item($user[0], new UserTransformer)
            ->setStatusCode(201);;
    }

    /**
     * Get user by ID
     *
     * @param int $userId
     * @return mixed
     */
    public function show($userId)
    {
        $user = $this->dispatch(new GetUser($userId));

        if (! $user) {
            return $this->response->errorNotFound();
        }

        return $this->response->item($user, new UserTransformer);
    }

    /**
     * Update user data
     *
     * Registra um novo usuario com `e-mail`, `username` e `password`.
     *
     * @Put("/")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({username": "foo", "email": "foo@foo.com", "password": "bar"}),
     *      @Response(200, body={"id": 10, "username": "foo", "email": "foo@foo.com"}),
     *      @Response(422, body={"error": {"username": {"Username is already taken."}}})
     *      @Response(422, body={"error": {"email": {"E-mail is already taken."}}})
     * })
     *
     * @param \Illuminate\Http\Request $request
     * @param int $userId
     * @return mixed
     */
    public function update(Request $request, $userId)
    {
        $validator = Validator::make($inputs, [
            'username' => 'max:255',
            'email'    => 'max:255',
            'password' => 'max:255',
        ]);

        if ($validator->fails()) {
            throw new UpdateResourceFailedException('Could not update user data.', $validator->errors());
        }

        try {
            $user = $this->dispacth(new UpdateUser($inputs));
        } catch (Execption $error) {
            return $this->response->errorInternal($error->getMessage());
        }

        return $this->response->item($user[0], new UserTransformer);
    }

    /**
     * Delete user by ID
     *
     * @Delete("/")
     * @Versions({"v1"})
     * @Transaction({
     *      @Request({username": "foo", "email": "foo@billovos.com.br", "password": "bar"}),
     *      @Response(200, body={"id": 10, "username": "foo", "email": "foo@billovos.com.br"}),
     *
     * @param int $userId
     * @return mixed
     */
    public function delete($userId)
    {
        try {
            $user = $this->dispacth(new DeleteUser($userId));
        } catch (Execption $error) {
            return $this->response->errorInternal($error->getMessage());
        }
    }
}