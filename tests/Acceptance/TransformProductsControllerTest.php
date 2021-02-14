<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Messenger\Transport\InMemoryTransport;

use function Safe\file_get_contents;

final class TransformProductsControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = WebTestCase::createClient();
    }

    public function test_can_handle_command_to_correct_transport(): void
    {
        //given
        $json = file_get_contents(__DIR__.'/Fixtures/request.json');
        //when
        $this->client->request('POST', '/transformProducts', [], [], [], $json);
        //then
        $this->assertResponseIsSuccessful();
        /* @var InMemoryTransport $transport */
        $transport = self::$container->get('messenger.transport.async');
        $this->assertCount(1, $transport->getSent());
    }
}
