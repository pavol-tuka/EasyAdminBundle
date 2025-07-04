<?php

namespace EasyCorp\Bundle\EasyAdminBundle\Dto;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
final class I18nDto
{
    private string $locale;
    private string $language;
    private string $textDirection;
    private string $translationDomain;
    /** @var array<string, mixed> */
    private array $translationParameters;

    /**
     * @param array<string, mixed> $translationParameters
     */
    public function __construct(string $locale, string $textDirection, string $translationDomain, array $translationParameters)
    {
        $this->locale = $locale;
        // returns 'en' for 'en', 'en-US', 'en_US', 'en-US.UTF-8', 'en_US.UTF-8', etc.
        $this->language = explode('-', str_replace('_', '-', $locale))[0];
        $this->textDirection = $textDirection;
        $this->translationDomain = $translationDomain;
        $this->translationParameters = $translationParameters;
    }

    /**
     * Returns the full locale formatted as ICU/Java/Symfony locales (e.g. 'es_ES', 'en_US').
     *
     * @see self::getHtmlLocale() if you need to format locale for HTML 'lang' attribute
     */
    public function getLocale(): string
    {
        return $this->locale;
    }

    /**
     * Returns the locale formatted as an IETF BCP 47 language tag, as required
     * by HTML 'lang' attribute (in practice, it replaces underscores by dashes).
     * Example: Symfony locale = 'es_ES'   HTML locale = 'es-ES'.
     *
     * @see self::getLocale() if you need to format locale for Symfony code
     */
    public function getHtmlLocale(): string
    {
        return str_replace('_', '-', $this->locale);
    }

    /**
     * Returns the language part of the locale (e.g. returns 'es' for 'es_ES' and 'zh' for 'zh_Hans_MO').
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getTextDirection(): string
    {
        return $this->textDirection;
    }

    public function getTranslationDomain(): string
    {
        return $this->translationDomain;
    }

    /**
     * @return array<string, mixed>
     */
    public function getTranslationParameters(): array
    {
        return $this->translationParameters;
    }
}
