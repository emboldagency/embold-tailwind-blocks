<div class="{{ $block->classes }} {{ $padding }}">
    @if ($statistics)
    Plugin version
      {{ $block->style }}
      <div>
        @foreach ($statistics as $statistic)
          <div>
              <div>{{ $statistic['number'] }}</div>
              <div>{{ $statistic['description'] }}</div>
          </div>
        @endforeach
      </div>
  
    @else
      <p>{{ $block->preview ? 'Add an item...' : 'No items found!' }}</p>
    @endif
  </div>
  