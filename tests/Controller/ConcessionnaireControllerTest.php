<?php

namespace App\Tests\Controller;

use App\Entity\Concessionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class ConcessionnaireControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/concessionnaire/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Concessionnaire::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Concessionnaire index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'concessionnaire[nom]' => 'Testing',
            'concessionnaire[groupe]' => 'Testing',
            'concessionnaire[adresse_numero]' => 'Testing',
            'concessionnaire[adresse_rue]' => 'Testing',
            'concessionnaire[adresse_ville]' => 'Testing',
            'concessionnaire[adresse_cp]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Concessionnaire();
        $fixture->setNom('My Title');
        $fixture->setGroupe('My Title');
        $fixture->setAdresse_numero('My Title');
        $fixture->setAdresse_rue('My Title');
        $fixture->setAdresse_ville('My Title');
        $fixture->setAdresse_cp('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Concessionnaire');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Concessionnaire();
        $fixture->setNom('Value');
        $fixture->setGroupe('Value');
        $fixture->setAdresse_numero('Value');
        $fixture->setAdresse_rue('Value');
        $fixture->setAdresse_ville('Value');
        $fixture->setAdresse_cp('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'concessionnaire[nom]' => 'Something New',
            'concessionnaire[groupe]' => 'Something New',
            'concessionnaire[adresse_numero]' => 'Something New',
            'concessionnaire[adresse_rue]' => 'Something New',
            'concessionnaire[adresse_ville]' => 'Something New',
            'concessionnaire[adresse_cp]' => 'Something New',
        ]);

        self::assertResponseRedirects('/concessionnaire/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getGroupe());
        self::assertSame('Something New', $fixture[0]->getAdresse_numero());
        self::assertSame('Something New', $fixture[0]->getAdresse_rue());
        self::assertSame('Something New', $fixture[0]->getAdresse_ville());
        self::assertSame('Something New', $fixture[0]->getAdresse_cp());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Concessionnaire();
        $fixture->setNom('Value');
        $fixture->setGroupe('Value');
        $fixture->setAdresse_numero('Value');
        $fixture->setAdresse_rue('Value');
        $fixture->setAdresse_ville('Value');
        $fixture->setAdresse_cp('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/concessionnaire/');
        self::assertSame(0, $this->repository->count([]));
    }
}
