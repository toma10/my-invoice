<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <x-avatar size="lg" :src="$user->avatarUrl()" />
        </div>
        <div class="ml-4">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            {{ $user->name }}
          </h3>
          <p class="text-sm leading-5 text-gray-500">
            {{ $user->email }}
          </p>
        </div>
      </div>
    </div>
    <div>
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Notifications
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Role
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $user->isAdmin() ? 'Administrator' : 'User' }}
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Created
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            {{ $user->created_at->toFormattedDateString() }}
          </dd>
        </div>
        @if (! $user->isActive())
          <div class="px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
            <dt class="text-sm leading-5 font-medium text-gray-500">
              Deactivated
            </dt>
            <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
              {{ $user->deactivated_at->toFormattedDateString() }}
            </dd>
          </div>
        @endif
      </dl>
    </div>
  </div>
