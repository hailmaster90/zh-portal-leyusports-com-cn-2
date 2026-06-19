<?php

class SiteMeta {
    private array $metaData;

    public function __construct(array $config = []) {
        $this->metaData = array_merge([
            'site_url'   => 'https://zh-portal-leyusports.com.cn',
            'site_name'  => '乐鱼体育',
            'keywords'   => ['乐鱼体育', '体育资讯', '赛事数据'],
            'description' => '乐鱼体育官方门户，提供最新体育动态与赛事数据服务。',
        ], $config);
    }

    public function getShortDescription(int $maxLength = 120): string {
        $base = $this->metaData['site_name'] . ' - ' . $this->metaData['description'];
        if (mb_strlen($base) <= $maxLength) {
            return $base;
        }
        return mb_substr($base, 0, $maxLength - 3) . '...';
    }

    public function generateMetaTags(): string {
        $tags = '';
        $tags .= '<meta name="keywords" content="' . $this->escapeHtml(implode(', ', $this->metaData['keywords'])) . '">' . "\n";
        $tags .= '<meta name="description" content="' . $this->escapeHtml($this->metaData['description']) . '">' . "\n";
        return $tags;
    }

    public function getSiteInfo(): array {
        return [
            'url'         => $this->metaData['site_url'],
            'name'        => $this->metaData['site_name'],
            'tagline'     => $this->getShortDescription(100),
        ];
    }

    // 示例：根据关键词数组返回简短摘要
    public function keywordSummary(string $separator = '、'): string {
        return implode($separator, $this->metaData['keywords']);
    }

    private function escapeHtml(string $input): string {
        return htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }
}

// 示例用法（可注释或保留作为参考）
$site = new SiteMeta();
echo $site->generateMetaTags();
echo "\n描述文本: " . $site->getShortDescription();
echo "\n关键词摘要: " . $site->keywordSummary();