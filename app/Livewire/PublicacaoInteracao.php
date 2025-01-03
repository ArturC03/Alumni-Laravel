<?php

namespace App\Livewire;

use App\Models\Publicacao;
use Closure;
use Livewire\Component;
use Livewire\Error;

class PublicacaoInteracao extends Component
{
    protected Publicacao $publicacao;

    protected string $icon;

    protected string $color;

    protected string $displayText;

    protected bool $active;

    protected Closure $action;

    public function mount(
        ?string $type = null,
        ?Publicacao $publicacao = null,
        ?string $icon = null,
        ?string $color = null,
        ?string $displayText = null,
        bool $active = false,
        ?Closure $action = null
    ) {
        $this->publicacao = $publicacao;

        if ($type) {
            $this->setTypeDefaults($type);

            return;
        }

        $this->setDefaults($icon, $color, $displayText, $active, $action);
    }

    protected function setTypeDefaults(string $type): void
    {
        if ($type === 'like') {
            $this->icon = 'heart';
            $this->color = 'primary';
            $this->displayText = fn () => $this->publicacao->LikesCount();
            $this->active = fn () => auth()->check() ? auth()->user()->Reagiu($this->publicacao->id) : false;
            $this->action = fn () => auth()->check() ? $this->publicacao->like() : null;
        }
    }

    protected function setDefaults(
        ?string $icon,
        ?string $color,
        ?string $displayText,
        bool $active,
        ?Closure $action
    ): void {
        try {
            $this->icon = $icon ?? 'default_icon'; // Provide defaults if necessary
            $this->color = $color ?? 'default_color'; // Provide defaults if necessary
            $this->displayText = $displayText ?? 'Default Text'; // Provide defaults if necessary
            $this->active = $active;
            $this->action = $action ?? fn () => null; // Provide a default closure
        } catch (\Exception $e) {
            Error::throw($e->getMessage());
        }
    }

    public function handleAction()
    {
        if ($this->action) {
            call_user_func($this->action); // Executes the closure
        }
    }

    public function render()
    {
        return view('livewire.publicacao-interacao', [
            'action' => $this->action,
            'icon' => $this->icon,
            'color' => $this->color,
            'displayText' => $this->displayText,
            'active' => $this->active,
        ]);
    }
}
