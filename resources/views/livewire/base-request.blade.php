<div>
    @if($step === 1)
    <livewire:accepting-terms />
    @elseif($step === 2)
    <livewire:auth-user :state="$state" />
    @elseif($step === 3)
    <livewire:create-post :state="$state" />
    @elseif($step === 4)
    <livewire:image-upload :state="$state" />
    @else
    <livewire:review-request :state="$state" />
    @endif
</div>