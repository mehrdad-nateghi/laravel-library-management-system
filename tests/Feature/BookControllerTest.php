<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
	use RefreshDatabase;

	public function test_index()
	{
		$book = Book::factory()->create();

		$this->get('api/books')
			 ->assertOk()
			 ->assertSee($book->title);
	}

	public function test_index_with_empty_database()
	{
		$this->get('api/books')
			 ->assertOk()
			 ->assertSee([]);
	}

	public function test_store()
	{
		$author = Author::factory()->create();

		$this->post('api/books',[
			'name'      => 'My Book',
			'author_id' => $author->id,
		])
			 ->assertStatus(200)
			 ->assertJsonPath('name','My Book');
	}

	public function test_store_with_invalid_data()
	{
		$this->post('api/books',[])
			 ->assertSessionHasErrors(['name','author_id']);
	}

	public function test_update()
	{
		$book   = Book::factory()->create();
		$author = Author::factory()->create();

		$response = $this->put('api/books/' . $book->id,[
			'name'      => 'Updated Title',
			'author_id' => $author->id,
		]);

		$this->assertDatabaseHas('books',[
			'id'        => $book->id,
			'name'      => 'Updated Title',
			'author_id' => $author->id,
		]);
	}

	public function test_update_with_invalid_data()
	{
		$book = Book::factory()->create();

		$this->put('api/books/' . $book->id,[])
			 ->assertSessionHasErrors(['name','author_id']);
	}

	public function test_destroy()
	{
		$book = Book::factory()->create();

		$this->delete('api/books/' . $book->id);

		$this->assertDatabaseMissing('books', [
			'id' => $book->id,
			'deleted_at' => null,
		]);
	}
}
