<?php

class Team {
 
    private ?int $id = null;
    private string $name;
    private string $description;
    private int $logo;
    private ?string $logoUrl = null;
    private ?string $logoAlt = null;
    
    public function __construct() 
    {
        
    }
    
    public function getId(): ?int
    {
        return $this->id;    
    }
    
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    
    public function getName(): string 
    {
        return $this->name;
    }
    
    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    public function getDescription(): string 
    {
        return $this->description;
    }
    
    public function setDescription(string $description): void 
    {
        $this->description = $description;
    }

    public function getIdLogo(): int 
    {
        return $this->logo;
    }
    
    public function setIdLogo(int $logo): void
    {
        $this->logo = $logo;
    }

    public function getLogoUrl(): ?string 
    {
        return $this->logoUrl;
    }
    
    public function setLogoUrl(?string $logoUrl): void
    {
        $this->logoUrl = $logoUrl;
    }

    public function getLogoAlt(): ?string 
    {
        return $this->logoAlt;
    }
    
    public function setLogoAlt(?string $logoAlt): void
    {
        $this->logoAlt = $logoAlt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'logo' => $this->logo,
            'logo_url' => $this->logoUrl,
            'logo_alt' -> $this->logoAlt
        ];
    }
}
?>