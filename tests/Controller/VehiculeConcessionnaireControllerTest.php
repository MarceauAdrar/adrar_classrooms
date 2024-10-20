<?php

namespace App\Tests\Controller;

use App\Entity\VehiculeConcessionnaire;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class VehiculeConcessionnaireControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/vehicule/concessionnaire/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(VehiculeConcessionnaire::class);

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
        self::assertPageTitleContains('VehiculeConcessionnaire index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'vehicule_concessionnaire[concessionnaire]' => 'Testing',
            'vehicule_concessionnaire[vehicule]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new VehiculeConcessionnaire();
        $fixture->setConcessionnaire('My Title');
        $fixture->setVehicule('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VehiculeConcessionnaire');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new VehiculeConcessionnaire();
        $fixture->setConcessionnaire('Value');
        $fixture->setVehicule('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'vehicule_concessionnaire[concessionnaire]' => 'Something New',
            'vehicule_concessionnaire[vehicule]' => 'Something New',
        ]);

        self::assertResponseRedirects('/vehicule/concessionnaire/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getConcessionnaire());
        self::assertSame('Something New', $fixture[0]->getVehicule());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new VehiculeConcessionnaire();
        $fixture->setConcessionnaire('Value');
        $fixture->setVehicule('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/vehicule/concessionnaire/');
        self::assertSame(0, $this->repository->count([]));
    }
}
