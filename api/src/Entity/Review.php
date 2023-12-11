<?php
// api/src/Entity/Review.php
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/** A review of a book. */
#[ApiResource]
#[ORM\Entity]
class Review
{
    /** The ID of this review. */
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $id = null;

    /** The rating of this review (between 0 and 5). */
    #[ORM\Column(type: 'integer')]
    public int $rating = 0;

    /** The body of the review. */
    #[ORM\Column(type: 'string')]
    public string $body = '';

    /** The author of the review. */
    #[ORM\Column(type: 'string')]
    public string $author = '';

    /** The date of publication of this review.*/
    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    public ?\DateTimeImmutable $publicationDate = null;

    /** The book this review is about. */
    #[ORM\ManyToOne]
    public ?Book $book = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
