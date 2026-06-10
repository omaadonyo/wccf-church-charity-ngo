<section class="py-24 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(!empty($data['heading']) || !empty($data['caption']))
            <div class="text-center mb-12 animate-on-scroll fade-in-up">
                @if(!empty($data['heading']))
                    <h2 class="font-heading text-3xl sm:text-4xl font-bold text-navy">{!! $data['heading'] !!}</h2>
                @endif
                @if(!empty($data['caption']))
                    <p class="text-gray-500 mt-4 max-w-2xl mx-auto">{{ $data['caption'] }}</p>
                @endif
            </div>
        @endif
        <div class="animate-on-scroll fade-in-up max-w-4xl mx-auto rounded-2xl overflow-hidden shadow-xl aspect-video">
            @if(($data['source_type'] ?? 'youtube') === 'youtube' && !empty($data['youtube_url']))
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([\w-]{11})/', $data['youtube_url'], $ytMatch);
                @endphp
                @if(!empty($ytMatch[1]))
                    <iframe src="https://www.youtube.com/embed/{{ $ytMatch[1] }}" title="Video" class="w-full h-full" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @endif
            @elseif(($data['source_type'] ?? '') === 'upload' && !empty($data['video_url']))
                <video controls class="w-full h-full" style="background:#000" preload="metadata">
                    <source src="{{ $data['video_url'] }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @elseif(!empty($data['url']))
                @php
                    preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|v\/)|youtu\.be\/)([\w-]{11})/', $data['url'], $ytMatch);
                @endphp
                @if(!empty($ytMatch[1]))
                    <iframe src="https://www.youtube.com/embed/{{ $ytMatch[1] }}" title="Video" class="w-full h-full" allowfullscreen></iframe>
                @else
                    <iframe src="{{ $data['url'] }}" title="Video" class="w-full h-full" allowfullscreen></iframe>
                @endif
            @endif
        </div>
    </div>
</section>
