<h3 class="text-lg leading-6 font-medium text-gray-900">
  Activity log
</h3>
<ul class="mt-6 space-y-4 divide divide-gray-200">
  @foreach ($activityLog as $activity)
    <li>
      <div class="flex items-center">
        <div class="min-w-0 flex-1 flex items-center">
          <div class="flex-shrink-0">
            <x-avatar :src="$activity->causer->avatarUrl()" size="md" />
          </div>
          <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-8">
            <div class="text-sm leading-5 truncate col-span-2">
              @switch($activity->description)
                @case(\App\InvoiceActivityTypes::CREATED)
                  You created invoice {{ $invoice->variable_symbol }}.
                  @break
                @case(\App\InvoiceActivityTypes::APPROVED)
                  <strong>{{ $activity->causer->name }}</strong> approved invoice {{ $invoice->variable_symbol }}.
                  @break
                @case(\App\InvoiceActivityTypes::DENIED)
                  <strong>{{ $activity->causer->name }}</strong> denied invoice {{ $invoice->variable_symbol }}.
                  @break
              @endswitch
            </div>
            <div class="hidden md:block">
              <div class="text-sm leading-5 text-gray-900">
                <time datetime="{{ $activity->created_at->toDateString() }}">
                  <x-tag size="md" variant="green"> {{ $activity->created_at->diffForHumans() }}</x-tag>
                </time>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </li>
</ul>
