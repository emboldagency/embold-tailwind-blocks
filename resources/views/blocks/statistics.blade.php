<div class="{{ $block->classes }} {{ $padding }}">
  @if ($statistics)
      
      @if ($block->style == 'list')
          <div class="py-6 md:px-6 border-gray-100 border">
              @foreach ($statistics as $statistic)
                  <div class="flex items-center gap-x-6 py-3">
                      <div class="text-4xl font-bold italic text-purple">{{ $statistic['number'] }}</div>
                      <div class="px-2 uppercase text-xs lg:text-base">{{ $statistic['description'] }}</div>
                  </div>
              @endforeach
          </div>

      @endif

      @if ($block->style == 'grid')
          <div class="py-6 md:px-6">
              <div class="grid grid-cols-2 gap-[1px] bg-gray-100">
                  @foreach ($statistics as $statistic)
                      <div class="flex flex-col items-center justify-center py-6 px-4  text-center bg-white ">
                          <div class="text-4xl font-bold italic text-purple">{{ $statistic['number'] }}</div>
                          <div class="px-2 uppercase text-xs lg:px-6 lg:text-base">{{ $statistic['description'] }}</div>
                      </div>
                  @endforeach
              </div>
          </div>
      @endif

      @if ($block->style == 'featured')
          <div class="grid grid-cols-2 gap-4 md:grid-cols-4 gap-y-4 py-6 md:px-6 lg:gap-x-12 xl:gap-x-24">
              @foreach ($statistics as $statistic)
                  <div class="p-4 aspect-square flex flex-col items-center justify-center text-center bg-contain bg-no-repeat" style="background-image: url('{{ $featured_background }}')">
                      <div class="text-4xl font-bold italic text-purple">{{ $statistic['number'] }}</div>
                      <div class="px-2 uppercase text-xs lg:px-6 lg:text-base">{{ $statistic['description'] }}</div>
                  </div>
              @endforeach
          </div>
      @endif

      @if ($block->style == 'full-width')
          <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-4">
              @foreach ($statistics as $statistic)
                  <div class="flex flex-col items-center justify-center" style="background-image: url('{{ $featured_background }}')">
                      <div class="text-purple">{{ $statistic['number'] }}</div>
                      <div class="uppercase">{{ $statistic['description'] }}</div>
                  </div>
              @endforeach
          </div>
      @endif

  @else
      <p>{{ $block->preview ? 'Add an item...' : 'No items found!' }}</p>
  @endif
</div>
