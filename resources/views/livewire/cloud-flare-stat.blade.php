<div class="feature-box cloudflare text-light">
    <p><span class="status-dot
        @if($cloudFlareStatus['status']['indicator'] == 'none') green
        @elseif($cloudFlareStatus['status']['indicator'] == 'minor') yellow
        @elseif($cloudFlareStatus['status']['indicator'] == 'major') orange
        @else red @endif" data-bs-toggle="tooltip" data-bs-placement="top" title="{{$cloudFlareStatus['status']['indicator']}}">
    </span> CloudFlare Status</p>
    <!--<p class="small-text">Checked: {{(date('Y-m-d H:m:s T', strtotime($cloudFlareStatus['page']['updated_at'])))}}</p>-->
</div>
