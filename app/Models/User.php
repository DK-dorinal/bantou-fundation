<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Les attributs qui sont assignables en masse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address',
        'latitude',
        'longitude',
        'birth_date',
        'gender',
        'profession',
        'motivation',
        'expertise_areas',
        'membership_type',
        'id_document',
        'is_anonymous',
        'donation_total',
        'organization_name',
        'sector',
        'contact_name',
        'position',
        'city_country',
        'partnership_type',
        'message',
        'attachment',
        'interests',
        'skills',
        'experience',
        'languages',
        'availability',
        'engagement',
        'duration',
        'expectations',
        'is_active',
        'email_verified_at',
    ];

    /**
     * Les attributs qui doivent être cachés pour la sérialisation.
     *
     * @var array<string, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Les attributs qui doivent être castés.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
        'expertise_areas' => 'array',
        'interests' => 'array',
        'skills' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'donation_total' => 'decimal:2',
        'is_active' => 'boolean',
        'is_anonymous' => 'boolean',
    ];

    /**
     * Les rôles disponibles pour les utilisateurs.
     */
    const ROLE_DONATEUR  = 'donateur';
    const ROLE_ADHERENT  = 'adherent';
    const ROLE_PARTENAIRE = 'partenaire';
    const ROLE_BENEVOLE  = 'benevole';
    const ROLE_ADMIN     = 'admin';

    /**
     * Liste de tous les rôles disponibles.
     *
     * @return array
     */
    public static function getRoles()
    {
        return [
            self::ROLE_DONATEUR   => 'Donateur',
            self::ROLE_ADHERENT   => 'Adhérent',
            self::ROLE_PARTENAIRE => 'Partenaire',
            self::ROLE_BENEVOLE   => 'Bénévole',
            self::ROLE_ADMIN      => 'Administrateur',
        ];
    }

    /**
     * Vérifie si l'utilisateur est un donateur.
     */
    public function isDonateur(): bool
    {
        return $this->role === self::ROLE_DONATEUR;
    }

    /**
     * Vérifie si l'utilisateur est un adhérent.
     */
    public function isAdherent(): bool
    {
        return $this->role === self::ROLE_ADHERENT;
    }

    /**
     * Vérifie si l'utilisateur est un partenaire.
     */
    public function isPartenaire(): bool
    {
        return $this->role === self::ROLE_PARTENAIRE;
    }

    /**
     * Vérifie si l'utilisateur est un bénévole.
     */
    public function isBenevole(): bool
    {
        return $this->role === self::ROLE_BENEVOLE;
    }

    /**
     * Vérifie si l'utilisateur est un administrateur.
     */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * Vérifie si l'utilisateur a un rôle spécifique.
     *
     * @param string|array $roles
     */
    public function hasRole($roles): bool
    {
        if (is_array($roles)) {
            return in_array($this->role, $roles);
        }
        return $this->role === $roles;
    }

    /**
     * Scope pour filtrer par rôle.
     */
    public function scopeWhereRole($query, $role)
    {
        return $query->where('role', $role);
    }

    /**
     * Scope pour les donateurs.
     */
    public function scopeDonateurs($query)
    {
        return $query->where('role', self::ROLE_DONATEUR);
    }

    /**
     * Scope pour les adhérents.
     */
    public function scopeAdherents($query)
    {
        return $query->where('role', self::ROLE_ADHERENT);
    }

    /**
     * Scope pour les partenaires.
     */
    public function scopePartenaires($query)
    {
        return $query->where('role', self::ROLE_PARTENAIRE);
    }

    /**
     * Scope pour les bénévoles.
     */
    public function scopeBenevoles($query)
    {
        return $query->where('role', self::ROLE_BENEVOLE);
    }

    /**
     * Scope pour les utilisateurs actifs.
     */
    public function scopeActif($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Obtient le libellé du rôle.
     */
    public function getRoleLabelAttribute(): string
    {
        return self::getRoles()[$this->role] ?? ucfirst($this->role);
    }

    /**
     * Obtient le nom complet de l'utilisateur.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Relation avec les dons (si l'utilisateur est donateur).
     */
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    /**
     * Relation avec les adhésions (si l'utilisateur est adhérent).
     */
    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    /**
     * Relation avec les demandes de partenariat.
     */
    public function partnershipRequests()
    {
        return $this->hasMany(PartnershipRequest::class);
    }

    /**
     * Relation avec les candidatures de bénévolat.
     */
    public function volunteerApplications()
    {
        return $this->hasMany(VolunteerApplication::class);
    }
}
