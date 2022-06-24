<div class="feature-box cloudflare text-light">
    <p>CloudFlare Status:</p>
    <p><span class="status-dot
        @if($cloudFlareStatus['status']['indicator'] == 'none') green
        @elseif($cloudFlareStatus['status']['indicator'] == 'minor') yellow
        @elseif($cloudFlareStatus['status']['indicator'] == 'major') orange
        @else red @endif">
    </span> {{$cloudFlareStatus['status']['indicator']}}</p>
    <!--<p class="small-text">Checked: {{(date('Y-m-d H:m:s T', strtotime($cloudFlareStatus['page']['updated_at'])))}}</p>-->
</div>
