# SEO Deployment Checklist - Live Site

## 🚀 Pre-Deployment Tasks

### Environment Setup

-   [ ] Update `.env` file with production settings
-   [ ] Set `APP_ENV=production`
-   [ ] Set `APP_DEBUG=false`
-   [ ] Configure production database
-   [ ] Set `APP_URL=https://staloysiusgonzaga.org/`

### Asset Optimization

-   [ ] Run `npm run build` or `npm run production`
-   [ ] Optimize images for web (WebP format recommended)
-   [ ] Compress CSS and JavaScript files
-   [ ] Generate favicon set (16x16, 32x32, 180x180)

## 🌐 SEO Configuration Updates

### Update URLs in SEO Service

-   [ ] Replace `URL::to('/')` with `config('app.url')`
-   [ ] Update sitemap generation to use production URLs
-   [ ] Test sitemap generation locally

### Update Configuration Files

-   [ ] Update `robots.txt` sitemap URL
-   [ ] Update `site.webmanifest` start URL
-   [ ] Verify all asset paths are correct

## 📊 Post-Deployment SEO Tasks

### 1. Generate Production Sitemap

```bash
php artisan sitemap:generate
```

### 2. Submit to Search Engines

-   [ ] **Google Search Console**

    -   Add property if not already added
    -   Submit sitemap: `https://staloysiusgonzaga.org/sitemap.xml`
    -   Request indexing for important pages
    -   Monitor for any crawl errors

-   [ ] **Bing Webmaster Tools**

    -   Add site and verify ownership
    -   Submit sitemap
    -   Monitor indexing status

-   [ ] **Yandex Webmaster** (if targeting Russian market)
    -   Add site and verify ownership
    -   Submit sitemap

### 3. SEO Testing & Validation

#### Meta Tags Testing

-   [ ] Check homepage meta tags
-   [ ] Verify page-specific meta titles and descriptions
-   [ ] Test Open Graph tags on Facebook Debugger
-   [ ] Test Twitter Cards on Twitter Card Validator

#### Structured Data Testing

-   [ ] Use Google's Rich Results Test
-   [ ] Validate JSON-LD schema markup
-   [ ] Check for any structured data errors
-   [ ] Test organization and school schema

#### Technical SEO Testing

-   [ ] Test robots.txt accessibility
-   [ ] Verify sitemap accessibility
-   [ ] Check canonical URLs
-   [ ] Test mobile responsiveness
-   [ ] Validate HTML markup

### 4. Performance Testing

-   [ ] **Google PageSpeed Insights**

    -   Test homepage performance
    -   Test key landing pages
    -   Address any performance issues

-   [ ] **GTmetrix**

    -   Comprehensive performance analysis
    -   Check loading speed
    -   Optimize if needed

-   [ ] **Mobile-Friendly Test**
    -   Ensure mobile optimization
    -   Check touch targets
    -   Verify responsive design

### 5. Analytics Setup

-   [ ] **Google Analytics 4**

    -   Set up tracking code
    -   Configure goals and conversions
    -   Set up enhanced ecommerce (if applicable)

-   [ ] **Google Search Console**
    -   Monitor search performance
    -   Track keyword rankings
    -   Monitor click-through rates

### 6. Social Media Setup

-   [ ] **Facebook Business Manager**

    -   Set up Facebook Pixel
    -   Configure custom audiences
    -   Test conversion tracking

-   [ ] **Social Media Profiles**
    -   Update profile links to new domain
    -   Test social sharing functionality
    -   Verify Open Graph images

## 🔧 Maintenance Setup

### Automated Tasks

-   [ ] Set up cron job for sitemap generation:

```bash
# Add to crontab
0 2 * * * cd /path/to/your/project && php artisan sitemap:generate
```

-   [ ] Set up automated backups
-   [ ] Configure monitoring alerts

### Regular Monitoring

-   [ ] **Weekly Tasks**

    -   Check Google Search Console for errors
    -   Monitor page load speeds
    -   Review analytics data

-   [ ] **Monthly Tasks**

    -   Update sitemap manually if needed
    -   Review and update meta descriptions
    -   Check for broken links
    -   Monitor keyword rankings

-   [ ] **Quarterly Tasks**
    -   Comprehensive SEO audit
    -   Update content strategy
    -   Review and optimize performance
    -   Check competitor analysis

## 🚨 Common Issues & Solutions

### Sitemap Issues

-   **Problem**: Sitemap not accessible
-   **Solution**: Check file permissions and .htaccess configuration

### Meta Tags Not Showing

-   **Problem**: Meta tags not appearing in search results
-   **Solution**: Clear cache and wait for re-indexing

### Performance Issues

-   **Problem**: Slow loading times
-   **Solution**: Optimize images, enable compression, use CDN

### SSL Issues

-   **Problem**: Mixed content warnings
-   **Solution**: Ensure all assets use HTTPS

## 📞 Emergency Contacts

### Technical Support

-   Hosting provider support
-   Domain registrar support
-   SSL certificate provider

### SEO Tools

-   Google Search Console: https://search.google.com/search-console
-   Google PageSpeed Insights: https://pagespeed.web.dev/
-   Google Rich Results Test: https://search.google.com/test/rich-results

## ✅ Final Verification Checklist

### Before Going Live

-   [ ] All URLs work correctly
-   [ ] Sitemap is accessible
-   [ ] Robots.txt is properly configured
-   [ ] SSL certificate is active
-   [ ] All meta tags are in place
-   [ ] Structured data is valid
-   [ ] Mobile responsiveness is confirmed
-   [ ] Performance is optimized
-   [ ] Analytics tracking is working
-   [ ] Social sharing is functional

### After Going Live

-   [ ] Submit sitemap to search engines
-   [ ] Monitor for any errors
-   [ ] Check search engine indexing
-   [ ] Verify all functionality works
-   [ ] Test contact forms and emails
-   [ ] Monitor performance metrics

---

**Remember**: SEO is a long-term process. Monitor your site's performance regularly and make adjustments as needed based on analytics data and search engine feedback.
