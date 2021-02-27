<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MovieController
 */
class MovieControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $movies = Movie::factory()->count(3)->create();

        $response = $this->get(route('movie.index'));

        $response->assertOk();
        $response->assertViewIs('movie.index');
        $response->assertViewHas('movies');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('movie.create'));

        $response->assertOk();
        $response->assertViewIs('movie.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovieController::class,
            'store',
            \App\Http\Requests\MovieStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $image = $this->faker->word;
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;

        $response = $this->post(route('movie.store'), [
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);

        $movies = Movie::query()
            ->where('image', $image)
            ->where('title', $title)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $movies);
        $movie = $movies->first();

        $response->assertRedirect(route('movie.index'));
        $response->assertSessionHas('movie.id', $movie->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $movie = Movie::factory()->create();

        $response = $this->get(route('movie.show', $movie));

        $response->assertOk();
        $response->assertViewIs('movie.show');
        $response->assertViewHas('movie');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $movie = Movie::factory()->create();

        $response = $this->get(route('movie.edit', $movie));

        $response->assertOk();
        $response->assertViewIs('movie.edit');
        $response->assertViewHas('movie');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MovieController::class,
            'update',
            \App\Http\Requests\MovieUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $movie = Movie::factory()->create();
        $image = $this->faker->word;
        $title = $this->faker->sentence(4);
        $description = $this->faker->text;

        $response = $this->put(route('movie.update', $movie), [
            'image' => $image,
            'title' => $title,
            'description' => $description,
        ]);

        $movie->refresh();

        $response->assertRedirect(route('movie.index'));
        $response->assertSessionHas('movie.id', $movie->id);

        $this->assertEquals($image, $movie->image);
        $this->assertEquals($title, $movie->title);
        $this->assertEquals($description, $movie->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $movie = Movie::factory()->create();

        $response = $this->delete(route('movie.destroy', $movie));

        $response->assertRedirect(route('movie.index'));

        $this->assertDeleted($movie);
    }
}
