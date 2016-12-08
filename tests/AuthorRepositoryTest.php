<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\AuthorRepository;

class AuthorRepositoryTest extends TestCase
{
    /**
     * Test for method show()
     *
     * @return void
     */
    public function testShow()
    {
        $idMockedAuthor = 25;
        $expected = [
            'id'            => $idMockedAuthor,
            'name'          => 'Arthur Conan Doyle',
            'book_count'    => 1,
        ];

        $mockModelAuthor = $this->getMockBuilder('App\Models\Author')
            ->setMethods(['getProfile'])
            ->getMock();
        $mockModelAuthor->expects($this->once())
            ->method('getProfile')
            ->with($idMockedAuthor)
            ->willReturn($expected);

        $model = new AuthorRepository($mockModelAuthor);
        $actual = $model->show($idMockedAuthor);

        $this->assertEquals($expected, $actual);
    }
}
