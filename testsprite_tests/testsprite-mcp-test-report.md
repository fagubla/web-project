
# TestSprite AI Testing Report (MCP)

---

## 1️⃣ Document Metadata
- **Project Name:** web-project
- **Date:** 2026-04-20
- **Prepared by:** TestSprite AI Team
- **Test Type:** Frontend E2E (Playwright in TestSprite cloud sandbox)
- **App URL:** http://127.0.0.1:8765 (Laravel artisan serve)
- **Login credentials used:** fabio@example.com / password
- **Project ID:** 8156c274-d32a-446d-92aa-0d0e3fbdcc9f

---

## 2️⃣ Requirement Validation Summary

### Requirement: User Login
- **Description:** Existing users can log in with valid credentials (with or without Remember Me); invalid credentials are rejected.

#### TC001 Log in and reach the dashboard
- **Test Code:** [TC001_Log_in_and_reach_the_dashboard.py](./TC001_Log_in_and_reach_the_dashboard.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/9b25d65b-dc56-441d-8f6c-bfaed21aead4
- **Status:** ✅ Passed
- **Analysis / Findings:** Login with valid credentials succeeds and redirects to the authenticated dashboard. Form validation and session handling work correctly.

#### TC010 Log in with Remember Me enabled
- **Test Code:** [TC010_Log_in_with_Remember_Me_enabled.py](./TC010_Log_in_with_Remember_Me_enabled.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/1f6300ad-8a0d-41aa-97c1-c7579273aeba
- **Status:** ✅ Passed
- **Analysis / Findings:** The Remember Me checkbox is present and can be toggled. Checking it before submitting results in a successful login and redirect to the dashboard with a persistent session cookie.

---

### Requirement: User Registration
- **Description:** New user can register with name, email, and password and land on the dashboard.

#### TC002 Register a new account and land on the dashboard
- **Test Code:** [TC002_Register_a_new_account_and_land_on_the_dashboard.py](./TC002_Register_a_new_account_and_land_on_the_dashboard.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/2aab24dc-3116-40bb-b003-4d49b49ce681
- **Status:** ✅ Passed
- **Analysis / Findings:** Registration flow works end-to-end. Form validation, user creation, and redirect to the authenticated dashboard all operate correctly.

---

### Requirement: Logout
- **Description:** Authenticated users can log out and are then barred from protected pages.

#### TC003 Log out from dashboard and lose access to protected pages
- **Test Code:** [TC003_Log_out_from_dashboard_and_lose_access_to_protected_pages.py](./TC003_Log_out_from_dashboard_and_lose_access_to_protected_pages.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/644da20a-b92d-4569-990f-e3fc980aa7ce
- **Status:** ✅ Passed
- **Analysis / Findings:** Logout from the sidebar user menu works correctly. After logging out, navigating to `/dashboard` correctly redirects to `/login`, confirming the session is properly destroyed.

---

### Requirement: Post Feed (Dashboard)
- **Description:** Authenticated users see a feed of posts, can create new posts, filter to their own posts, and the dashboard redirects guests to login.

#### TC004 Create a post and see it appear at the top of the global feed
- **Test Code:** [TC004_Create_a_post_and_see_it_appear_at_the_top_of_the_global_feed.py](./TC004_Create_a_post_and_see_it_appear_at_the_top_of_the_global_feed.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/eec4c10a-d782-46a7-a24d-909626f779dc
- **Status:** ✅ Passed
- **Analysis / Findings:** Authenticated users can fill the post textarea, submit, and the new post appears immediately at the top of the feed.

#### TC005 Block access to dashboard when unauthenticated
- **Test Code:** [TC005_Block_access_to_dashboard_when_unauthenticated.py](./TC005_Block_access_to_dashboard_when_unauthenticated.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/d0142816-d79f-43af-ba77-06c7eace9ec7
- **Status:** ✅ Passed
- **Analysis / Findings:** Unauthenticated navigation to `/dashboard` correctly redirects to `/login`.

#### TC007 Filter feed between My Posts and All posts
- **Test Code:** [TC007_Filter_feed_between_My_Posts_and_All_posts.py](./TC007_Filter_feed_between_My_Posts_and_All_posts.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/df2b5c62-dab0-485a-91db-3fd4ece757bf
- **Status:** ❌ Failed
- **Severity:** Medium
- **Analysis / Findings:** Clicking the "My Posts" filter tab did not restrict the feed to the authenticated user's posts. The feed continued to display posts by other authors (e.g., Marvin Donnelly, Chris Satterfield). The filter UI element is present and clickable, but the underlying query or reactive state is not applying the user-specific filter correctly.
- **Recommended Fix:** Verify the `Dashboard.vue` filter logic — the `?filter=my` query parameter or equivalent reactive prop must be passed to `PageController@dashboard` and the controller must scope the `Post` query with `->where('user_id', auth()->id())` when the filter is active.

---

### Requirement: Profile Settings
- **Description:** Users can update their name and email.

#### TC006 Update profile name and email successfully
- **Test Code:** [TC006_Update_profile_name_and_email_successfully.py](./TC006_Update_profile_name_and_email_successfully.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/3d6fab70-3227-4981-9d7d-3fae41d3c2ab
- **Status:** ✅ Passed
- **Analysis / Findings:** The profile settings form correctly saves an updated name and email and shows a success confirmation.

---

### Requirement: Password Settings
- **Description:** Users can change their current password; incorrect current password is rejected.

#### TC008 Change password successfully while logged in
- **Test Code:** [TC008_Change_password_successfully_while_logged_in.py](./TC008_Change_password_successfully_while_logged_in.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/5e6c03eb-0ab0-42be-bb0e-a15b373709e9
- **Status:** ✅ Passed
- **Analysis / Findings:** Password change flow works correctly. The user can change their password using the settings form and a success message is shown.

#### TC014 Password change shows error when current password is incorrect
- **Test Code:** [TC014_Password_change_shows_error_when_current_password_is_incorrect.py](./TC014_Password_change_shows_error_when_current_password_is_incorrect.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/991eb8b1-2dd0-4b38-a480-f74e2104d425
- **Status:** ✅ Passed
- **Analysis / Findings:** Submitting an incorrect current password correctly surfaces a validation error, preventing unauthorized password changes.

---

### Requirement: Appearance Settings
- **Description:** Users can switch the app theme between light, dark, and system; selection persists across reloads and route changes.

#### TC009 Switch to Dark theme applies immediately
- **Test Code:** [TC009_Switch_to_Dark_theme_applies_immediately.py](./TC009_Switch_to_Dark_theme_applies_immediately.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/294cec3f-ae36-44f8-83a8-98354bf6e2a3
- **Status:** ✅ Passed
- **Analysis / Findings:** Selecting the Dark theme applies the dark class to the page immediately.

#### TC011 Switch to Light theme applies immediately
- **Test Code:** [TC011_Switch_to_Light_theme_applies_immediately.py](./TC011_Switch_to_Light_theme_applies_immediately.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/c5cdb3c9-5baf-4544-a497-4dcdf51a2ec5
- **Status:** ✅ Passed
- **Analysis / Findings:** Selecting the Light theme applies the light appearance immediately.

#### TC012 Switch to System theme applies immediately
- **Test Code:** [TC012_Switch_to_System_theme_applies_immediately.py](./TC012_Switch_to_System_theme_applies_immediately.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/aa0ec6cc-7732-44f7-a5ef-21326e806dda
- **Status:** ✅ Passed
- **Analysis / Findings:** Switching to System theme correctly mirrors the OS-level preference.

#### TC013 Theme selection persists after page reload
- **Test Code:** [TC013_Theme_selection_persists_after_page_reload.py](./TC013_Theme_selection_persists_after_page_reload.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/f4bb5290-532d-4657-ac9f-49dc0336c8cd
- **Status:** ✅ Passed
- **Analysis / Findings:** Theme preference is persisted (via localStorage or cookie) and correctly re-applied after a full page reload.

#### TC015 Theme selection persists across route changes
- **Test Code:** [TC015_Theme_selection_persists_across_route_changes.py](./TC015_Theme_selection_persists_across_route_changes.py)
- **Test Visualization and Result:** https://www.testsprite.com/dashboard/mcp/tests/8156c274-d32a-446d-92aa-0d0e3fbdcc9f/31b1defa-d282-4c49-9693-15f1259f0eec
- **Status:** ✅ Passed
- **Analysis / Findings:** The selected theme is maintained when navigating between routes within the SPA (e.g., settings → dashboard).

---

## 3️⃣ Coverage & Matching Metrics

- **14 / 15 tests passed (93.33%)**

| Requirement           | Total Tests | ✅ Passed | ❌ Failed |
|-----------------------|-------------|-----------|----------|
| User Login            | 2           | 2         | 0        |
| User Registration     | 1           | 1         | 0        |
| Logout                | 1           | 1         | 0        |
| Post Feed (Dashboard) | 3           | 2         | 1        |
| Profile Settings      | 1           | 1         | 0        |
| Password Settings     | 2           | 2         | 0        |
| Appearance Settings   | 5           | 5         | 0        |
| **Total**             | **15**      | **14**    | **1**    |

---

## 4️⃣ Key Gaps / Risks

### 🔴 Medium — "My Posts" filter does not filter the feed (TC007)
Clicking the **My Posts** tab on the dashboard feed has no visible effect — posts authored by other users remain visible. The filter UI renders correctly, but either:
- The query parameter (`?filter=my` or equivalent) is not being sent to the backend, or
- `PageController@dashboard` is not scoping the `Post` query to `auth()->id()` when the filter is active.

**Fix:** Inspect `Dashboard.vue` to confirm the filter tab emits the correct reactive state or URL parameter change, then verify that `PageController@dashboard` reads that parameter and applies:
```php
$posts = $filter === 'my'
    ? Post::where('user_id', auth()->id())->latest()->with('user')->get()
    : Post::latest()->with('user')->get();
```

---

### 🟡 Low — No pagination on the post feed
The dashboard loads **all posts at once** with no paginator. As the post count grows, this will cause slow page loads and a degraded user experience.

**Fix:** Paginate in `PageController@dashboard`:
```php
$posts = Post::latest()->with('user')->paginate(20);
```
And add a `<Pagination>` component to `Dashboard.vue` to render the pagination links.

---

### 🟢 Low — Friend and profile routes are inactive
The friend-add, friend-accept, public profile (`/profile/{user}`), and status (`/status`) routes are commented out in `routes/web.php`. This is an intentional WIP state, but worth tracking as the friend-based "My Posts" filter will always be limited until friends are implemented.
