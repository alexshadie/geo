<?php


namespace alexshadie\geo;


class CountryService implements CountryServiceInterface
{
    /** @var CountryRepositoryInterface */
    private $countryRepository;

    /**
     * CountryService constructor.
     * @param CountryRepositoryInterface $countryRepository
     */
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * @inheritDoc
     */
    public function getCountryById(int $countryId): ?Country
    {
        return $this->countryRepository->getCountryById($countryId);
    }

    /**
     * @inheritdoc
     */
    public function getCountryByCode(string $countryCode): ?Country
    {
        return $this->countryRepository->getCountryByCode($countryCode);
    }
}