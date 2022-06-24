<div class="cloudflare text-light">
    <p>CloudFlareStatus:</p>
    <p>{{$cloudFlareStatus['status']['indicator']}}</p>
    <p>Checked: {{(date('Y-m-d H:m:s T', strtotime($cloudFlareStatus['page']['updated_at'])))}}</p>
    <div class="
        @if($cloudFlareStatus['status']['indicator'] == 'none') green
        @elseif($cloudFlareStatus['status']['indicator'] == 'minor') yellow
        @elseif($cloudFlareStatus['status']['indicator'] == 'major') orange
        @else red @endif">
    </div>
</div>
