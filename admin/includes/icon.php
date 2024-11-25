<?php
function icExtlink($size = "1rem", $stroke = 1.5)
{
  return <<<EOT
  <svg width='$size' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="$stroke" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
  </svg>
  EOT;
}

function icMail($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" version="1.1" id="lni_lni-envelope" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
  <path d="M56,9.6H8c-3.4,0-6.3,2.8-6.3,6.3v32.4c0,3.4,2.8,6.3,6.3,6.3h48c3.4,0,6.3-2.8,6.3-6.3V15.8C62.3,12.4,59.4,9.6,56,9.6z
    M56,14.1c0.1,0,0.2,0,0.3,0L32,29.7L7.7,14.1c0.1,0,0.2,0,0.3,0H56z M56,49.9H8c-1,0-1.8-0.8-1.8-1.8V18.5l23.4,15
    c0.7,0.5,1.5,0.7,2.3,0.7c0.8,0,1.6-0.2,2.3-0.7l23.4-15v29.7C57.8,49.2,57,49.9,56,49.9z"/>
  </svg>
  EOT;
}

function icLinkedIn($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M58.5016 1H5.60156C3.10156 1 1.10156 3 1.10156 5.5V58.5C1.10156 60.9 3.10156 63 5.60156 63H58.3016C60.8016 63 62.8016 61 62.8016 58.5V5.4C63.0016 3 61.0016 1 58.5016 1ZM19.4016 53.7H10.3016V24.2H19.4016V53.7ZM14.8016 20.1C11.8016 20.1 9.50156 17.7 9.50156 14.8C9.50156 11.9 11.9016 9.5 14.8016 9.5C17.7016 9.5 20.1016 11.9 20.1016 14.8C20.1016 17.7 17.9016 20.1 14.8016 20.1ZM53.9016 53.7H44.8016V39.4C44.8016 36 44.7016 31.5 40.0016 31.5C35.2016 31.5 34.5016 35.3 34.5016 39.1V53.7H25.4016V24.2H34.3016V28.3H34.4016C35.7016 25.9 38.6016 23.5 43.1016 23.5C52.4016 23.5 54.1016 29.5 54.1016 37.7V53.7H53.9016Z"/></svg>
  EOT;
}

function icFacebook($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" x="0px" y="0px" width="$size" height="$size" viewBox="0 0 28 28">
      <path d="M15,3C8.373,3,3,8.373,3,15c0,6.016,4.432,10.984,10.206,11.852V18.18h-2.969v-3.154h2.969v-2.099c0-3.475,1.693-5,4.581-5 c1.383,0,2.115,0.103,2.461,0.149v2.753h-1.97c-1.226,0-1.654,1.163-1.654,2.473v1.724h3.593L19.73,18.18h-3.106v8.697 C22.481,26.083,27,21.075,27,15C27,8.373,21.627,3,15,3z"></path>
  </svg>
  EOT;
}

function icInsta($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" x="0px" y="0px" width="$size" height="$size" viewBox="0 0 24 24">
      <path d="M 8 3 C 5.243 3 3 5.243 3 8 L 3 16 C 3 18.757 5.243 21 8 21 L 16 21 C 18.757 21 21 18.757 21 16 L 21 8 C 21 5.243 18.757 3 16 3 L 8 3 z M 8 5 L 16 5 C 17.654 5 19 6.346 19 8 L 19 16 C 19 17.654 17.654 19 16 19 L 8 19 C 6.346 19 5 17.654 5 16 L 5 8 C 5 6.346 6.346 5 8 5 z M 17 6 A 1 1 0 0 0 16 7 A 1 1 0 0 0 17 8 A 1 1 0 0 0 18 7 A 1 1 0 0 0 17 6 z M 12 7 C 9.243 7 7 9.243 7 12 C 7 14.757 9.243 17 12 17 C 14.757 17 17 14.757 17 12 C 17 9.243 14.757 7 12 7 z M 12 9 C 13.654 9 15 10.346 15 12 C 15 13.654 13.654 15 12 15 C 10.346 15 9 13.654 9 12 C 9 10.346 10.346 9 12 9 z"></path>
  </svg>
  EOT;
}

function icPhone($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" version="1.1" id="lni_lni-phone" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
    y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
  <g>
    <path d="M48.6,60.9c-8.1,0-19.6-5.8-30.2-15.8C4,31.3-2.1,15.9,4.3,9.1c0.3-0.3,0.7-0.6,1.1-0.8l8.1-4.6c2.1-1.2,4.7-0.6,6.1,1.4
      l5.9,8.4c0.7,1,1,2.2,0.7,3.4C26,18,25.3,19,24.3,19.7L20.8,22c2.7,3.9,10,13.6,21.6,20.5c0.1,0.1,0.2,0,0.2,0l2.5-3.4
      c1.4-1.9,4.1-2.4,6.2-1.1l8.8,5.6c2.1,1.3,2.7,4,1.4,6.1l-4.8,7.7c-0.3,0.4-0.6,0.8-0.9,1.1C54,60.1,51.5,60.9,48.6,60.9z
      M15.8,7.6C15.8,7.6,15.7,7.6,15.8,7.6l-8.2,4.6c-3.8,4.1,0.9,17.2,14,29.6c13.3,12.6,27,17.1,31.4,13.3l0,0c0,0,0,0,0,0l4.8-7.7
      l-8.8-5.6c-0.1,0-0.2,0-0.2,0l-2.5,3.4c-1.4,1.9-4.1,2.4-6.1,1.2c-12.5-7.5-20.3-17.9-23.1-22c-0.7-1-0.9-2.2-0.7-3.3
      c0.2-1.2,0.9-2.2,1.9-2.8l3.5-2.3l-5.8-8.3C15.9,7.7,15.8,7.6,15.8,7.6z"/>
  </g>
  </svg>
  EOT;
}

function icWhatsapp($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M54 9.90039C48.2 4.10039 40.3 0.900391 32.2 0.900391C15.2 0.900391 1.3 14.7004 1.3 31.7004C1.3 37.2004 2.7 42.4004 5.4 47.2004L1 63.1004L17.5 58.9004C22 61.3004 27.1 62.7004 32.3 62.7004C49.2 62.6004 63 48.8004 63 31.7004C63 23.5004 59.8 15.8004 54 9.90039ZM32.1 57.4004C27.6 57.4004 22.9 56.1004 19 53.7004L18 53.1004L8.3 55.6004L11 46.2004L10.4 45.2004C7.9 41.1004 6.5 36.3004 6.5 31.5004C6.5 17.4004 17.9 6.00039 32.1 6.00039C38.9 6.00039 45.3 8.70039 50.1 13.5004C54.9 18.3004 57.6 24.8004 57.6 31.7004C57.8 46.0004 46.2 57.4004 32.1 57.4004ZM46.2 38.2004C45.4 37.8004 41.7 35.9004 40.8 35.8004C40.1 35.5004 39.5 35.4004 39.1 36.2004C38.7 37.0004 37.1 38.6004 36.7 39.2004C36.3 39.6004 35.9 39.8004 35 39.3004C34.2 38.9004 31.8 38.2004 28.8 35.4004C26.5 33.4004 24.9 30.9004 24.6 30.0004C24.2 29.2004 24.5 28.9004 25 28.4004C25.4 28.0004 25.8 27.6004 26.1 27.0004C26.5 26.6004 26.5 26.2004 26.9 25.7004C27.3 25.3004 27 24.7004 26.8 24.3004C26.5 23.9004 25.1 20.1004 24.4 18.5004C23.8 16.9004 23.1 17.2004 22.7 17.2004C22.3 17.2004 21.7 17.2004 21.3 17.2004C20.9 17.2004 19.9 17.3004 19.3 18.2004C18.6 19.0004 16.6 20.9004 16.6 24.7004C16.6 28.5004 19.3 32.0004 19.8 32.7004C20.2 33.1004 25.3 41.0004 32.9 44.4004C34.7 45.2004 36.1 45.7004 37.3 46.1004C39.1 46.7004 40.8 46.5004 42.1 46.4004C43.6 46.3004 46.6 44.6004 47.3 42.7004C47.9 41.0004 47.9 39.3004 47.7 39.0004C47.5 38.8004 46.9 38.5004 46.2 38.2004Z"/></svg>
EOT;
}

function iHam($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width='$size' fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
</svg>
EOT;
}

function iClose($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width='$size' fill="none" viewBox="0 0 24 24" stroke-width="2.25" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
</svg>
EOT;
}

function iSearch($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
EOT;
}

function iLocation($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width='$size' fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
</svg>
EOT;
}


function icD($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" version="1.1" id="lni_lni-seo-consulting" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    x="0px" y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
  <g>
    <path d="M25.1,23.6c0,4,3.2,7.2,7.2,7.2c4,0,7.2-3.2,7.2-7.2s-3.2-7.2-7.2-7.2C28.4,16.3,25.1,19.6,25.1,23.6z M35.6,23.6
      c0,1.8-1.5,3.2-3.2,3.2s-3.2-1.5-3.2-3.2s1.5-3.2,3.2-3.2S35.6,21.8,35.6,23.6z"/>
    <path d="M8.1,31.7c0.5,0,0.9-0.2,1.2-0.4l7.1-5.6c0.9-0.7,1-1.9,0.3-2.8c-0.7-0.9-1.9-1-2.8-0.3l-3.6,2.9
      C12.9,15.3,21.9,8.2,32.4,8.2c10.5,0,19.6,7.1,22.2,17.3c0.3,1.1,1.4,1.7,2.4,1.4c1.1-0.3,1.7-1.4,1.4-2.4
      c-3-12-13.8-20.4-26.1-20.4c-12.2,0-22.8,8.2-25.9,20L4.1,21c-0.7-0.9-1.9-1.1-2.8-0.4c-0.9,0.7-1.1,1.9-0.4,2.8l5.6,7.5
      c0.3,0.4,0.8,0.7,1.3,0.8C7.9,31.7,8,31.7,8.1,31.7z"/>
    <path d="M62.8,44.8l-3.9-8.5c-0.2-0.5-0.6-0.9-1.2-1.1c-0.5-0.2-1.1-0.1-1.6,0.1l-8.1,4c-1,0.5-1.4,1.7-0.9,2.7
      c0.5,1,1.7,1.4,2.7,0.9l3.9-1.9c-1.8,4.8-5.1,8.7-9.2,11.3v-9.4c0-5.1-3.8-9.3-8.5-9.3h-7.7c-4.7,0-8.5,4.2-8.5,9.4v9
      c-4.2-2.8-7.4-6.9-9-11.9c-0.3-1-1.5-1.6-2.5-1.3c-1,0.3-1.6,1.5-1.3,2.5c3.6,11,13.8,18.4,25.4,18.4c11.1,0,21-6.8,25-17.1
      l1.7,3.8c0.3,0.7,1.1,1.2,1.8,1.2c0.3,0,0.6-0.1,0.8-0.2C62.8,47,63.2,45.8,62.8,44.8z M23.8,54.1V42.9c0-3,2-5.4,4.5-5.4h1.8v6.9
      c0,1.1,0.9,2,2,2c1.1,0,2-0.9,2-2v-6.9H36c2.5,0,4.5,2.4,4.5,5.3v11.4c-2.6,1-5.3,1.5-8.2,1.5C29.3,55.8,26.4,55.2,23.8,54.1z"/>
  </g>
  </svg>

EOT;
}

function iDVC($size = "1rem")
{
  return <<<EOT
  <svg width="$size" height="$size" viewBox="0 0 204 234" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M41.4932 70.1681C57.208 70.1681 69.9482 57.4283 69.9482 41.713C69.9482 25.9977 57.208 13.2579 41.4932 13.2579C25.7783 13.2579 13.0381 25.9977 13.0381 41.713C13.0381 57.4283 25.7783 70.1681 41.4932 70.1681ZM41.4932 83.1681C64.3877 83.1681 82.9482 64.608 82.9482 41.713C82.9482 18.818 64.3877 0.257935 41.4932 0.257935C18.5986 0.257935 0.0380859 18.818 0.0380859 41.713C0.0380859 64.608 18.5986 83.1681 41.4932 83.1681ZM91.3652 41.8594V41.713C91.3652 36.1709 90.4619 30.8398 88.793 25.8594H139.251C140.302 25.8585 141.343 26.0648 142.313 26.4663C143.285 26.8678 144.167 27.4567 144.911 28.1993L200.911 84.1993C201.653 84.9429 202.242 85.8254 202.645 86.7966C203.046 87.7677 203.252 88.8085 203.251 89.8594V217.859C203.251 222.103 201.565 226.172 198.564 229.173C195.564 232.174 191.494 233.859 187.251 233.859H43.251C39.0078 233.859 34.9375 232.174 31.9375 229.173C28.9365 226.172 27.251 222.103 27.251 217.859V89.522C31.7637 90.8644 36.5439 91.5851 41.4932 91.5851C41.6973 91.5851 41.9004 91.5839 42.1035 91.5814C42.4873 91.5768 42.8701 91.5679 43.251 91.5547V217.859H187.251V97.8594H139.251C137.129 97.8594 135.095 97.0165 133.594 95.5162C132.094 94.016 131.251 91.9811 131.251 89.8594V41.8594H91.3652ZM175.941 81.8594L147.251 53.1694V81.8594H175.941ZM59.7246 35.5387C61.6768 33.5861 61.6768 30.4203 59.7246 28.4677C57.7715 26.515 54.6064 26.515 52.6533 28.4677L36.7695 44.3518L30.332 37.9149C28.3799 35.9623 25.2139 35.9623 23.2617 37.9149C21.3086 39.8676 21.3086 43.0333 23.2617 44.986L33.2334 54.9584C34.1719 55.8961 35.4434 56.4229 36.7695 56.4229C38.0957 56.4229 39.3672 55.8961 40.3047 54.9584L59.7246 35.5387ZM77.2822 124C73.541 124 70.5078 127.033 70.5078 130.775C70.5078 134.516 73.541 137.549 77.2822 137.549C81.0234 137.549 84.0566 134.516 84.0566 130.775C84.0566 127.033 81.0234 124 77.2822 124ZM77.2822 145C85.1387 145 91.5078 138.631 91.5078 130.775C91.5078 122.918 85.1387 116.549 77.2822 116.549C69.4258 116.549 63.0566 122.918 63.0566 130.775C63.0566 138.631 69.4258 145 77.2822 145ZM70.5078 176.417C70.5078 172.675 73.541 169.642 77.2822 169.642C81.0234 169.642 84.0566 172.675 84.0566 176.417C84.0566 180.158 81.0234 183.191 77.2822 183.191C73.541 183.191 70.5078 180.158 70.5078 176.417ZM91.5078 176.417C91.5078 184.273 85.1387 190.642 77.2822 190.642C69.4258 190.642 63.0566 184.273 63.0566 176.417C63.0566 168.56 69.4258 162.191 77.2822 162.191C85.1387 162.191 91.5078 168.56 91.5078 176.417ZM99.3945 123.367C99.3945 121.429 100.965 119.859 102.902 119.859H165.42C167.357 119.859 168.928 121.429 168.928 123.367C168.928 125.304 167.357 126.875 165.42 126.875H102.902C100.965 126.875 99.3945 125.304 99.3945 123.367ZM102.902 166.416C100.965 166.416 99.3945 167.987 99.3945 169.924C99.3945 171.861 100.965 173.432 102.902 173.432H165.42C167.357 173.432 168.928 171.861 168.928 169.924C168.928 167.987 167.357 166.416 165.42 166.416H102.902ZM99.3945 136.352C99.3945 134.415 100.965 132.844 102.902 132.844H135.894C137.831 132.844 139.401 134.415 139.401 136.352C139.401 138.289 137.831 139.86 135.894 139.86H102.902C100.965 139.86 99.3945 138.289 99.3945 136.352ZM102.902 179.402C100.965 179.402 99.3945 180.972 99.3945 182.91C99.3945 184.847 100.965 186.417 102.902 186.417H135.894C137.831 186.417 139.401 184.847 139.401 182.91C139.401 180.972 137.831 179.402 135.894 179.402H102.902Z" fill="currentColor" />
  </svg>
EOT;
}

function iSDSR($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" />
  </svg>
EOT;
}

function iOMS($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" version="1.1" id="lni_lni-support" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
    y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
  <g>
    <path d="M30.9,20.3H14c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2h16.8c1.2,0,2.2-1,2.2-2.2S32.1,20.3,30.9,20.3z"/>
    <path d="M21.8,32.7H14c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2h7.7c1.2,0,2.2-1,2.2-2.2S23,32.7,21.8,32.7z"/>
    <path d="M48.6,34.5c-0.1-0.1-0.2-0.2-0.4-0.2c-0.1-0.1-0.3-0.1-0.4-0.1c-0.7-0.1-1.5,0.1-2,0.6c-0.1,0.1-0.2,0.2-0.3,0.3
      c-0.1,0.1-0.2,0.3-0.2,0.4c-0.1,0.1-0.1,0.3-0.1,0.4c0,0.2-0.1,0.3-0.1,0.4c0,0.2,0,0.3,0.1,0.4c0,0.2,0.1,0.3,0.1,0.4
      c0.1,0.1,0.1,0.3,0.2,0.4c0.1,0.1,0.2,0.2,0.3,0.3c0.4,0.4,1,0.7,1.6,0.7c0.6,0,1.2-0.2,1.6-0.7c0.1-0.1,0.2-0.2,0.3-0.3
      c0.1-0.1,0.1-0.2,0.2-0.4c0.1-0.1,0.1-0.3,0.1-0.4c0-0.1,0-0.3,0-0.4c0-0.6-0.2-1.2-0.7-1.6C48.8,34.7,48.7,34.6,48.6,34.5z"/>
    <path d="M47.9,15.9c-2.5-0.3-4.8,0.9-6,3.1c-0.6,1.1-0.2,2.5,0.9,3c1.1,0.6,2.5,0.2,3-0.9c0.3-0.5,0.9-0.8,1.5-0.7
      c0.6,0.1,1.2,0.6,1.2,1.1c0.1,0.7-0.3,1.1-0.7,1.3c-1.7,0.8-2.9,2.8-2.9,4.6v1.3c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-1.3
      c0-0.2,0.2-0.5,0.4-0.6c2.2-1.1,3.5-3.4,3.2-5.9C52.7,18.3,50.5,16.2,47.9,15.9z"/>
    <path d="M56,7.9H8c-3.4,0-6.2,2.8-6.2,6.2v37.7c0,1.6,0.9,3.1,2.4,3.8c0.6,0.3,1.2,0.4,1.8,0.4c1,0,1.9-0.3,2.7-1l8.5-7H56
      c3.4,0,6.2-2.8,6.2-6.2V14.2C62.2,10.7,59.4,7.9,56,7.9z M57.8,41.8c0,1-0.8,1.8-1.8,1.8H16.3c-0.5,0-1,0.2-1.4,0.5l-8.6,7.1v-37
      c0-1,0.8-1.8,1.8-1.8h48c1,0,1.8,0.8,1.8,1.8V41.8z"/>
  </g>
  </svg>

EOT;
}


function iTKP($size = "1rem")
{
  return <<<EOT
  <svg fill="currentColor" width="$size" height="$size" version="1.1" id="lni_lni-rocket" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
    y="0px" viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
  <g>
    <path d="M61.4,19.5l-8.2-8.2l-0.3-0.3c-0.6-0.4-1.2-0.6-1.8-0.6l-12.9,1.1C28.5,3.4,16.3-0.1,6,2.7C4.4,3.1,3.1,4.4,2.7,6
      c-2.8,10.2,0.7,22.5,8.9,32.1l-1.1,12.7l0,0.2c0,0.6,0.2,1.3,0.6,1.8l8.5,8.6c0.6,0.6,1.3,0.9,2.1,0.9c0.3,0,0.6,0,0.8-0.1
      c1-0.3,1.8-1.2,2.1-2.2l1.2-10.7c1.4,0.7,2.8,1.3,4.2,1.8c0.5,0.2,1,0.3,1.5,0.3c1.3,0,2.5-0.5,3.4-1.4l14.9-14.9
      c1.3-1.3,1.8-3.3,1.2-5c-0.5-1.4-1.1-2.8-1.8-4.2l10.5-1.2l0.2,0c1.1-0.2,1.9-1,2.2-2.1C62.4,21.4,62.2,20.3,61.4,19.5z M20.4,56
      L15,50.5l0.7-8.1c1.8,1.6,3.7,3.1,5.7,4.4L20.4,56z M46.6,31.8L31.8,46.6c-0.1,0.1-0.2,0.1-0.3,0.1c-5.2-1.8-10.2-5-14.3-9.1
      C8.4,28.7,4.4,16.8,7,7.2C7.1,7.1,7.1,7,7.2,7h0c2-0.5,4-0.8,6.1-0.8c8.3,0,17.3,3.9,24.2,10.9c4.1,4.1,7.3,9.1,9.1,14.3
      C46.7,31.6,46.7,31.7,46.6,31.8z M46.8,21.5c-1.3-2-2.8-4-4.4-5.8l8.1-0.7l5.4,5.4L46.8,21.5z"/>
    <path d="M55.3,40.2c-0.3-0.2-1.4-0.7-2.6,0.3c-1,0.8-5.7,5.5-6.6,6.4c-6.4,6.4-6.4,6.4-6,7.8c0.1,0.4,0.3,0.8,0.6,1
      c3.2,3.2,8.1,3.9,11.8,3.9c2.8,0,4.9-0.4,5.1-0.5c0.9-0.2,1.6-0.9,1.8-1.8c0.1-0.5,2.2-11.2-3.5-16.9
      C55.6,40.4,55.4,40.3,55.3,40.2z M55.1,55.1c-2.6,0.3-6.6,0.3-9.6-1.2c2.2-2.2,6.1-6.2,8.3-8.3C55.3,48.4,55.3,52.5,55.1,55.1z"/>
    <path d="M26.1,17.8c-4.6,0-8.3,3.7-8.3,8.3s3.7,8.3,8.3,8.3s8.3-3.7,8.3-8.3S30.7,17.8,26.1,17.8z M26.1,30c-2.1,0-3.8-1.7-3.8-3.8
      s1.7-3.8,3.8-3.8S30,24,30,26.1S28.2,30,26.1,30z"/>
  </g>
  </svg>
EOT;
}

function iRight($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
</svg>
EOT;
}

function iLeft($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
</svg>
EOT;
}

function iTick($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
  <path d="M20 6 9 17l-5-5"/>
</svg>
EOT;
}

function iEx($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
</svg>
EOT;
}

function iJob($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
</svg>
EOT;
}

function iCurrency($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
</svg>
EOT;
}

function iSad($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="$size">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 16.318A4.486 4.486 0 0 0 12.016 15a4.486 4.486 0 0 0-3.198 1.318M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
</svg>
EOT;
}

function iTrash($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
EOT;
}

function iEye($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye">
  <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/>
</svg>
EOT;
}

function iEyeOff($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye-off"><path d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49"/><path d="M14.084 14.158a3 3 0 0 1-4.242-4.242"/>
  <path d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143"/><path d="m2 2 20 20"/>
</svg>
EOT;
}

function iDark($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-moon">
  <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/>
</svg>
EOT;
}

function iLight($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sun">
  <circle cx="12" cy="12" r="4"/>
  <path d="M12 2v2"/>
  <path d="M12 20v2"/>
  <path d="m4.93 4.93 1.41 1.41"/>
  <path d="m17.66 17.66 1.41 1.41"/>
  <path d="M2 12h2"/><path d="M20 12h2"/>
  <path d="m6.34 17.66-1.41 1.41"/>
  <path d="m19.07 4.93-1.41 1.41"/>
</svg>
EOT;
}

function iHome($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-house">
  <path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"/>
  <path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
</svg>
EOT;
}

function iFile($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-text">
  <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/>
  <path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M10 9H8"/>
  <path d="M16 13H8"/><path d="M16 17H8"/>
</svg>
EOT;
}

function iAbout($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard">
  <rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/>
  <rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/>
</svg>
EOT;
}

function iLogout($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
EOT;
}

function iControls($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sliders-horizontal"><line x1="21" x2="14" y1="4" y2="4"/><line x1="10" x2="3" y1="4" y2="4"/><line x1="21" x2="12" y1="12" y2="12"/><line x1="8" x2="3" y1="12" y2="12"/><line x1="21" x2="16" y1="20" y2="20"/><line x1="12" x2="3" y1="20" y2="20"/><line x1="14" x2="14" y1="2" y2="6"/><line x1="8" x2="8" y1="10" y2="14"/><line x1="16" x2="16" y1="18" y2="22"/></svg>
EOT;
}

function iLogout2($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-arrow-out-up-right"><path d="M22 12A10 10 0 1 1 12 2"/><path d="M22 2 12 12"/><path d="M16 2h6v6"/></svg>
EOT;
}

function iServices($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-list"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/><path d="M14 4h7"/><path d="M14 9h7"/><path d="M14 15h7"/><path d="M14 20h7"/></svg>
EOT;
}

function iBrain($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-brain"><path d="M12 5a3 3 0 1 0-5.997.125 4 4 0 0 0-2.526 5.77 4 4 0 0 0 .556 6.588A4 4 0 1 0 12 18Z"/><path d="M12 5a3 3 0 1 1 5.997.125 4 4 0 0 1 2.526 5.77 4 4 0 0 1-.556 6.588A4 4 0 1 1 12 18Z"/><path d="M15 13a4.5 4.5 0 0 1-3-4 4.5 4.5 0 0 1-3 4"/><path d="M17.599 6.5a3 3 0 0 0 .399-1.375"/><path d="M6.003 5.125A3 3 0 0 0 6.401 6.5"/><path d="M3.477 10.896a4 4 0 0 1 .585-.396"/><path d="M19.938 10.5a4 4 0 0 1 .585.396"/><path d="M6 18a4 4 0 0 1-1.967-.516"/><path d="M19.967 17.484A4 4 0 0 1 18 18"/></svg>
EOT;
}

function iSolution($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-wrench"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
EOT;
}

function iProjects($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-folder-git-2"><path d="M9 20H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h3.9a2 2 0 0 1 1.69.9l.81 1.2a2 2 0 0 0 1.67.9H20a2 2 0 0 1 2 2v5"/><circle cx="13" cy="12" r="2"/><path d="M18 19c-2.8 0-5-2.2-5-5v8"/><circle cx="20" cy="19" r="2"/></svg>
EOT;
}

function iCareers($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-briefcase-business"><path d="M12 12h.01"/><path d="M16 6V4a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/><path d="M22 13a18.15 18.15 0 0 1-20 0"/><rect width="20" height="14" x="2" y="6" rx="2"/></svg>
EOT;
}

function iUpload($size = "1rem")
{
  return <<<EOT
<svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cloud-upload"><path d="M12 13v8"/><path d="M4 14.899A7 7 0 1 1 15.71 8h1.79a4.5 4.5 0 0 1 2.5 8.242"/><path d="m8 17 4-4 4 4"/></svg>
EOT;
}

function iCheck($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
EOT;
}

function iChevronRight($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-right"><path d="m9 18 6-6-6-6"/></svg>
EOT;
}

function iChevronLeft($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-left"><path d="m15 18-6-6 6-6"/></svg>
EOT;
}

function iContainer($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-container"><path d="M22 7.7c0-.6-.4-1.2-.8-1.5l-6.3-3.9a1.72 1.72 0 0 0-1.7 0l-10.3 6c-.5.2-.9.8-.9 1.4v6.6c0 .5.4 1.2.8 1.5l6.3 3.9a1.72 1.72 0 0 0 1.7 0l10.3-6c.5-.3.9-1 .9-1.5Z"/><path d="M10 21.9V14L2.1 9.1"/><path d="m10 14 11.9-6.9"/><path d="M14 19.8v-8.1"/><path d="M18 17.5V9.4"/></svg>
EOT;
}

function iStats($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
EOT;
}

function iHandShake($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-handshake"><path d="m11 17 2 2a1 1 0 1 0 3-3"/><path d="m14 14 2.5 2.5a1 1 0 1 0 3-3l-3.88-3.88a3 3 0 0 0-4.24 0l-.88.88a1 1 0 1 1-3-3l2.81-2.81a5.79 5.79 0 0 1 7.06-.87l.47.28a2 2 0 0 0 1.42.25L21 4"/><path d="m21 3 1 11h-2"/><path d="M3 3 2 14l6.5 6.5a1 1 0 1 0 3-3"/><path d="M3 4h8"/></svg>
EOT;
}

function iPen($size = "1rem")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
EOT;
}

function iPlus($size = "1rem", $stroke = 2)
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="$stroke" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
EOT;
}

function iHeadset($size = "1rem", $stroke = "2")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-headset"><path d="M3 11h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-5Zm0 0a9 9 0 1 1 18 0m0 0v5a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3Z"/><path d="M21 16v2a4 4 0 0 1-4 4h-5"/></svg>
EOT;
}

function iCircleTick($size = "1rem", $stroke = "2")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="$stroke" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-check-big"><path d="M21.801 10A10 10 0 1 1 17 3.335"/><path d="m9 11 3 3L22 4"/></svg>
EOT;
}

function iCircleX($size = "1rem", $stroke = "2")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="$stroke" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>
EOT;
}

function iSettings($size = "1rem", $stroke = "2")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="$stroke" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
EOT;
}

function iInfo($size = "1rem", $stroke = "2")
{
  return <<<EOT
  <svg xmlns="http://www.w3.org/2000/svg" width="$size" height="$size" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="$stroke" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-info"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
EOT;
}
