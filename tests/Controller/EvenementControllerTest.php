<?php

namespace App\Test\Controller;

use App\Entity\Evenement;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EvenementControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/evenement/front/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Evenement::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evenement index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'evenement[titreEv]' => 'Testing',
            'evenement[categorieEv]' => 'Testing',
            'evenement[descriptionEv]' => 'Testing',
            'evenement[imageEv]' => 'Testing',
            'evenement[adresseEv]' => 'Testing',
            'evenement[region]' => 'Testing',
            'evenement[dateEv]' => 'Testing',
            'evenement[nbrePlaces]' => 'Testing',
            'evenement[idG]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setTitreEv('My Title');
        $fixture->setCategorieEv('My Title');
        $fixture->setDescriptionEv('My Title');
        $fixture->setImageEv('My Title');
        $fixture->setAdresseEv('My Title');
        $fixture->setRegion('My Title');
        $fixture->setDateEv('My Title');
        $fixture->setNbrePlaces('My Title');
        $fixture->setIdG('My Title');

        $this->repository->save($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Evenement');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setTitreEv('Value');
        $fixture->setCategorieEv('Value');
        $fixture->setDescriptionEv('Value');
        $fixture->setImageEv('Value');
        $fixture->setAdresseEv('Value');
        $fixture->setRegion('Value');
        $fixture->setDateEv('Value');
        $fixture->setNbrePlaces('Value');
        $fixture->setIdG('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'evenement[titreEv]' => 'Something New',
            'evenement[categorieEv]' => 'Something New',
            'evenement[descriptionEv]' => 'Something New',
            'evenement[imageEv]' => 'Something New',
            'evenement[adresseEv]' => 'Something New',
            'evenement[region]' => 'Something New',
            'evenement[dateEv]' => 'Something New',
            'evenement[nbrePlaces]' => 'Something New',
            'evenement[idG]' => 'Something New',
        ]);

        self::assertResponseRedirects('/evenement/front/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitreEv());
        self::assertSame('Something New', $fixture[0]->getCategorieEv());
        self::assertSame('Something New', $fixture[0]->getDescriptionEv());
        self::assertSame('Something New', $fixture[0]->getImageEv());
        self::assertSame('Something New', $fixture[0]->getAdresseEv());
        self::assertSame('Something New', $fixture[0]->getRegion());
        self::assertSame('Something New', $fixture[0]->getDateEv());
        self::assertSame('Something New', $fixture[0]->getNbrePlaces());
        self::assertSame('Something New', $fixture[0]->getIdG());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Evenement();
        $fixture->setTitreEv('Value');
        $fixture->setCategorieEv('Value');
        $fixture->setDescriptionEv('Value');
        $fixture->setImageEv('Value');
        $fixture->setAdresseEv('Value');
        $fixture->setRegion('Value');
        $fixture->setDateEv('Value');
        $fixture->setNbrePlaces('Value');
        $fixture->setIdG('Value');

        $$this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/evenement/front/');
        self::assertSame(0, $this->repository->count([]));
    }
}
