<p>Your claimed item, {!! $claim->listable->getTitle() !!}, for ${{ $claim->price }}, was accepted by the seller.</p>
<p>You can view details of the item and claim here: <a href="{{ route('profile.claims.show', [$claim->getUUID()]) }}">{{ route('profile.claims.show', [$claim->getUUID()]) }}</a></p>